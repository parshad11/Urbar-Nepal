<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Session;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
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
        $statuses = $this->taskStatus();
        if ($request->ajax()) {
            if (auth()->user()->can('task.view') && auth()->user()->can('view_own_task')) {
                $task = Task::all();
            }
            if (auth()->user()->can('view_own_task') && !auth()->user()->can('task.view')) {
                $task = Task::where('assign_to', Auth::user()->id);
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
                    $status ='<a href="#" class="update_status" data-status="' . $row->status . '" data-href="' . action("TaskController@statusupdate", [$row->id]) . '"><span class="label ' . $status_color .'">' . $statuses[$row->status] . '</span></a>';

                    return $status;
                })
                ->rawColumns(['action', 'status'])
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
        $user = User::role('Delivery#' . $business_id)->get();
        return view('task.create', compact('user'));
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
        $task = new Task();
        $task->fill($data);
        $success = $task->save();
        if ($success) {
            return redirect()->route('task.index')->with('success', 'Task added successfully');
        } else {
            return redirect()->route('task.index')->with('error', 'Sorry! there is an error while adding task');
        }
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
        $task = Task::findorfail($id);
        $business_id = request()->session()->get('user.business_id');
        $user = User::role('Delivery#' . $business_id)->get();
        return view('task.edit', compact('task', 'user'));
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
        $task = Task::findorfail($id);
        $data = $request->validate([
            'status' => 'required',
        ]);
        $task->fill($data);
        $success = $task->save();
        $output = ['success' => 1,
            'msg' => __('Task status updated succesfully')
        ];
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
                $task = Task::findorfail($id);
                $task->delete();
                $output = ['success' => true,
                    'msg' => __("task deleted")
                ];

            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = ['success' => false,
                    'msg' => __("something went wrong")
                ];
            }
            return $output;
        }
    }

    private function taskStatus()
    {
        return [
            'received' => __('received'),
            'on process' => __('on process'),
            'completed' => __('completed'),
            'cancelled' => __('cancelled')
        ];
    }
}

