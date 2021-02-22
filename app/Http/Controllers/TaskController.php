<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\Task;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\RecordUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Session;

class TaskController extends Controller
{
    protected $moduleUtil;
    protected $recordUtil;
    protected $productUtil;

    public function __construct(ModuleUtil $moduleUtil,ProductUtil $productUtil,RecordUtil $recordUtil)
    {
        $this->moduleUtil=$moduleUtil;
        $this->productUtil=$productUtil;
        $this->recordUtil=$recordUtil;

        $this->status_colors = [
            'received' => 'bg-purple',
            'on process' => 'bg-yellow',
            'completed' => 'bg-green',
            'cancelled' => 'bg-red',
        ];
    }

    public function index(Request $request)
    {

        if (!auth()->user()->can('task.view') && !auth()->user()->can('view_own_task')) {
            abort(403, 'Unauthorized action.');
        }
        $statuses = $this->productUtil->taskStatuses();
        if ($request->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $tasks = $this->recordUtil->getListTasks($business_id);
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $tasks->whereIn('tasks.location_id', $permitted_locations);
            }

            if (!empty(request()->location_id)) {
                $tasks->where('tasks.location_id', request()->location_id);
            }

            if (!empty(request()->task_status)) {
                $tasks->where('tasks.task_status', request()->status);
            }
            
            if (!empty(request()->start_date) && !empty(request()->end_date)) {
                $start = request()->start_date;
                $end =  request()->end_date;
                $tasks->whereDate('tasks.started_at', '>=', $start)
                            ->whereDate('tasks.started_at', '<=', $end);
            }

            if (!auth()->user()->can('task.view') && auth()->user()->can('view_own_task')) {
                $tasks->where('tasks.assigned_by', request()->session()->get('user.id'));
            }
           
            return Datatables::of($tasks)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                        data-toggle="dropdown" aria-expanded="false">' .
                        __("messages.actions") .
                        '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">';
                    if (auth()->user()->can("task.view")) {
                        $html .= '<li><a href="#" data-href="' . action('TaskController@show', [$row->id]) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-eye" aria-hidden="true"></i>' . __("messages.view") . '</a></li>';
                    }
                    if (auth()->user()->can('task.update')) {
                        $html .=  '<li><a href="' . action('TaskController@edit', [$row->id]) . '"><i class="fas fa-edit"></i> ' . __("messages.edit") . '</a></li>';
                    }
                    if (auth()->user()->can('task.delete')) {
                        $html .= '<li><a href="' . action('TaskController@destroy', [$row->id]) . '" class="delete-task"><i class="fas fa-trash"></i> ' . __("messages.delete") . '</a></li>';
                    }
                    $html .=  '</ul></div>';
                    return $html;
                })
                ->editColumn('task_status', function($row) use($statuses) {
                    $row->task_status = $row->task_status == 'final' ? 'completed' : $row->task_status;
                    $status =  $statuses[$row->task_status];
                    $status_color = !empty($this->status_colors[$row->task_status]) ? $this->status_colors[$row->task_status] : 'bg-gray';
                    $status ='<a href="#" class="update_status" data-status="' . $row->task_status . '" data-href="' . action("TaskController@statusupdate", [$row->id]) . '"><span class="label ' . $status_color .'">' . $statuses[$row->task_status] . '</span></a>';

                    return $status;
                })
                ->removeColumn('id')
                ->rawColumns(['action', 'task_status'])
                ->make(true);

        } else {
            return view('task.index')->with(compact('statuses'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('task.assign')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id, false, true);
        $bl_attributes = $business_locations['attributes'];
        $business_locations = $business_locations['locations'];
        $taskTypes = $this->productUtil->taskTypes();
        $taskStatuses = $this->productUtil->taskStatuses();
        $delivery_people=User::allDeliveryPersonDropdown($business_id,false);
        return view('task.create')->with(compact('delivery_people','business_locations','bl_attributes','taskTypes','taskStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('task.assign')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $task_details = $request->only(['delivery_person_id','location_id','task_address','title','task_latitude','task_longitude','task_status','task_type','special_instructions','description']);
        $request->validate([
            'delivery_person_id' => 'required',
            'location_id' => 'required',
            'title' => 'required',
            'task_latitude' => 'required',
            'task_longitude' => 'required',
            'task_status' => 'required',
            'task_type' => 'required',

        ]);
        $business_id = $request->session()->get('user.business_id');
        $user_id = $request->session()->get('user.id');
        $task_details['assigned_by'] = $user_id;
        $task_details['business_id'] = $business_id;
        DB::beginTransaction(); 
        
        $task = Task::create($task_details);
        
        DB::commit();
        $output = ['success' => 1,
        'msg' => __('delivery.task_added_success')
        ];
        } catch (\Exception $e) {
             DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
             $output = ['success' => 0,
                'msg' => __("messages.something_went_wrong")
            ];
           
        }
        return redirect('task')->with('status',$output);
    }

    public function getActiveWork(Request $request)
    {
        if (!auth()->user()->can('task.view') && !auth()->user()->can('view_own_task')) {
            abort(403, 'Unauthorized action.');
        }
        $statuses = $this->taskStatus();
        if ($request->ajax()) {
            if (auth()->user()->can('task.view') && auth()->user()->can('view_own_task')) {
                $task = Task::where('status','received')->get();
            }
            if (auth()->user()->can('view_own_task') && !auth()->user()->can('task.view')) {
                $task = Task::where('status','received')->where('assign_to', Auth::user()->id);
            }
            return Datatables::of($task)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('task.update')) {
                        $action = '<a href="' . action('TaskController@edit', [$row->id]) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> ' . __("messages.edit") . '</a>';
                    }
                    if (auth()->user()->can('task.delete')) {
                        $action .= '&nbsp
                                <button data-href="' . action('TaskController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_role_button"><i class="glyphicon glyphicon-trash"></i> ' . __("messages.delete") . '</button>';
                    } else {
                        $action = null;
                    }

                    return $action;
                })
                ->addColumn('assign to',
                    function ($row) {
                        $assign_to = $this->task->task_assign($row->assign_to);
                        return $assign_to;
                    })
                ->addColumn('location',
                    function ($row) {
                        $location = $this->task->location($row->id);
                        return $location;
                    })
                ->addColumn('date',
                    function ($row) {
                        $date = $this->task->date($row->id);
                        return $date;
                    })
                ->editColumn('status', function($row) use($statuses) {
                    $row->status = $row->status == 'final' ? 'completed' : $row->status;
                    $status =  $statuses[$row->status];
                    $status_color = !empty($this->status_colors[$row->status]) ? $this->status_colors[$row->status] : 'bg-gray';
                    $status ='<p><span class="label ' . $status_color .'">' . $statuses[$row->status] . '</span></p>';

                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);

        } else {
            return view('task.receivedtask');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('task.update')) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = request()->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id);
        $taskTypes = $this->productUtil->taskTypes();
        $taskStatuses = $this->productUtil->taskStatuses();
        $delivery_people=User::allDeliveryPersonDropdown($business_id,false);

        $task = Task::where('business_id', $business_id)
        ->where('id', $id)
        ->with(
            'delivery_person',
            'location',
            'record_staff'
        )
        ->first();
       
        return view('task.edit')->with(compact('task', 'delivery_people','taskStatuses','taskTypes','business_locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('task.update')) {
            abort(403, 'Unauthorized action.');
        }
        $task = Task::findorfail($id);
        $data = $request->validate([
            'assign_to' => 'required|integer',
            'task_type' => 'required',
            'title' => 'required|',
            'description' => '',
            'special_instruction' => '',
            'start_lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'start_log' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'end_lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'end_log' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        $task->fill($data);
        $success = $task->save();
        if ($success) {
            return redirect()->route('task.index')->with('success', 'Task updated successfully');
        } else {
            return redirect()->route('task.index')->with('error', 'Sorry! there is an error while updating task');
        }

    }
    public function statusupdate(Request $request, $id){
        if (!auth()->user()->can('task.update')) {
            abort(403, 'Unauthorized action.');
        }
        try {
        $task = Task::findorfail($id);

        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        $update_data['status'] = $request->input('status');
        $task->update($update_data);
        DB::commit();

        $output = ['success' => 1,
            'msg' => __('Task status updated succesfully')
        ];
        } catch (\Exception $e) {
        DB::rollBack();
        \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
        
        $output = ['success' => 0,
                        'msg' => $e->getMessage()
                    ];
        }
        return $output;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('task.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                DB::beginTransaction();
                $task = Task::findorfail($id);
                $task->delete();
                DB::commit();
                $output = ['success' => true,
                    'msg' => __("task deleted sucessfully")
                ];

            } catch (\Exception $e) {
                DB::rollBack();
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = ['success' => false,
                    'msg' => __("something went wrong")
                ];
            }
            return $output;
        }
    }

}

