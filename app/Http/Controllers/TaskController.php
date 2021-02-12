<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Session;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index(Request $request)
    {

        if (!auth()->user()->can('task.view') && !auth()->user()->can('view_own_task')) {
            abort(403, 'Unauthorized action.');
        }
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
                ->addColumn('location', function () {
                    $task = Task::all();
                    foreach ($task as $task) {
                        $location = $task->start_loc . '-' . $task->end_loc;
                        return $location;
                    }
                })
                ->addColumn('date', function () {
                    $task = Task::all();
                    foreach ($task as $task) {
                        $date = $task->start_date . '-' . $task->end_date;
                        return $date;
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);

        } else {
            return view('task.index');
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
        dd($request->all());
        if (!auth()->user()->can('task.assign')) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->validate([
            'assign_to' => 'required|integer',
            'task_type' => 'required',
            'title' => 'required|',
            'description' => '',
            'special_instruction' => '',
            'start_loc' => 'required',
            'end_loc' => 'required',
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

    public function getActiveWork()
    {
        //
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
            'start_loc' => 'required',
            'end_loc' => 'required',
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
}
