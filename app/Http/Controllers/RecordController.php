<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Contact;


class RecordController extends Controller
{
    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    public function index(Request $request)
    {
        if (!(auth()->user()->can('record.view') || auth()->user()->can('record.view_own'))) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->ajax()) {
            $record = Record::all();
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $location=$request->location;
            if (!empty($start_date) && !empty($end_date || !empty($request->location))) {
                $data=$record->whereBetween('date', [$start_date, $end_date]);
            }
            if (!empty($request->location) ) {
                $data=Record::where('location', 'like', '%' . $location. '%');
            }
            if (!empty($start_date) && !empty($end_date && !empty($request->location))) {
                $data=Record::whereBetween('date', [$start_date, $end_date])->where('location', 'like', '%' . $location. '%');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('record.update')) {
                        $action = '<a href="' . action('RecordController@edit', [$row->id]) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> ' . __("messages.edit") . '</a>';
                    }
                    if (auth()->user()->can('record.delete')) {
                        $action .= '&nbsp
                                <button data-href="' . action('RecordController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_role_button"><i class="glyphicon glyphicon-trash"></i> ' . __("messages.delete") . '</button>';
                    }
                    else{
                        $action=null;
                    }
                    return $action;
                })
                ->addColumn(
                    'supplier name',
                    function ($row) {
                        $data=Record::all();
                        $supplier_name = $this->record->contact_supplier($row->supplier_id);
                        return $supplier_name;
                    }
                )
                ->rawColumns(['action', 'supplier name'])
                ->make(true);
        } else {
            return view('record.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('record.create')) {
            abort(403, 'Unauthorized action.');
        }
        $contact = Contact::where('type', 'supplier')->get();
        return view('record.create', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('record.create')) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->validate([
            'supplier_id' => 'required|integer',
            'item' => 'required',
            'quantity' => '',
            'date' => 'required|date',
            'location' => 'required|string',
        ]);
        $record = new Record;
        $record->fill($data);
        $success = $record->save();
        if ($success) {
            return redirect()->route('record.index')->with('success', 'Supplier upcomming record added successfully');
        } else {
            return redirect()->route('record.index')->with('error', 'Sorry! there is an error while adding supplier upcomming record');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('record.update')) {
            abort(403, 'Unauthorized action.');
        }
        $record = Record::findorfail($id);
        $contact = Contact::where('type', 'supplier')->get();
        return view('record.edit', compact('record', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('record.update')) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->validate([
            'supplier_id' => 'required|integer',
            'item' => 'required',
            'quantity' => '',
            'date' => 'required|date',
            'location' => 'required|string',
        ]);
        $record = Record::findorfail($id);
        $record->fill($data);
        $success = $record->save();
        if ($success) {
            return redirect()->route('record.index')->with('success', 'Supplier upcomming record updated successfully');
        } else {
            return redirect()->route('record.index')->with('error', 'Sorry! there is an error while updating supplier upcomming record');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('record.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $record = Record::findorfail($id);
                $record->delete();
                $output = ['success' => true,
                    'msg' => __("record deleted")
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
