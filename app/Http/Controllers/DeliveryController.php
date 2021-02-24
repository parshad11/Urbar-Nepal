<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\Contact;
use App\Delivery;
use App\User;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    protected $moduleUtil;
    protected $transactionUtil;

    public function __construct( TransactionUtil $transactionUtil, ModuleUtil $moduleUtil,Delivery $delivery)
    {
        
        $this->transactionUtil = $transactionUtil;
        $this->delivery = $delivery;
        $this->moduleUtil = $moduleUtil;
        $this->assign_status_colors = [
            '1' =>  'bg-green',
            '0' => 'bg-red'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('delivery.view') && !auth()->user()->can('view_own_delivery')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        if ($request->ajax()) {
            $delivery=$this->delivery->all();
//            dd($delivery);
            return Datatables::of($delivery)
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
                    if (auth()->user()->can("delivery.view")) {
                        $html .= '<li><a href="#" data-href="' . action('DeliveryController@show', [$row->id]) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-eye" aria-hidden="true"></i>' . __("messages.view") . '</a></li>';
                    }
                    if (auth()->user()->can('delivery.update')) {
                        $html .=  '<li><a href="' . action('DeliveryController@edit', [$row->id]) . '"><i class="fas fa-edit"></i> ' . __("messages.edit") . '</a></li>';
                    }
                    if (auth()->user()->can('delivery.delete')) {
                        $html .= '<li><a href="' . action('DeliveryController@destroy', [$row->id]) . '" class="delete-task"><i class="fas fa-trash"></i> ' . __("messages.delete") . '</a></li>';
                    }
                    $html .=  '</ul></div>';
                    return $html;
                })
                ->addColumn('delivery_person',function ($row){
                    $delivery_person=$this->moduleUtil->getDeliveryUser($row->delivery_person_id);
                    return $delivery_person;
                })
                ->removeColumn('id')
                ->rawColumns(['action', 'task_status'])
                ->make(true);
//
        } else {
            return view('delivery.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        
    }

  
    public function listDeliveryTransaction(Request $request)
    {
        if (!auth()->user()->can('purchase.view') &&  !auth()->user()->can('view_own_purchase') && !auth()->user()->can('direct_sell.access') && !auth()->user()->can('sell.view') && !auth()->user()->can('view_own_sell_only')) {
            abort(403, 'Unauthorized action.');
        }
        
        $business_id = request()->session()->get('user.business_id');
        $assignStatuses = $this->transactionUtil->delivery_assign_statuses();
        if ($request->ajax()) {
            $transactions = $this->transactionUtil->getListTransactions($business_id);
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $transactions->whereIn('transactions.location_id', $permitted_locations);
            }

            if (request()->has('created_by')) {
                $created_by = request()->get('created_by');
                if (!empty($created_by)) {
                    $transactions->where('transactions.created_by', $created_by);
                }
            }

            
            if (!empty(request()->customer_id)) {
                $customer_id = request()->customer_id;
                $transactions->where('contacts.id', $customer_id);
            }

            if (!auth()->user()->can('direct_sell.access') && auth()->user()->can('view_own_sell_only')) {
                $transactions->where('transactions.created_by', request()->session()->get('user.id')->where('transactions.type','sell'));
            }

            if (!auth()->user()->can('purchase.view') && auth()->user()->can('view_own_purchase')) {
                $transactions->where('transactions.created_by', request()->session()->get('user.id')->where('transactions.type','purchase'));
            }

            if (request()->has('location_id')) {
                $location_id = request()->get('location_id');
                if (!empty($location_id)) {
                    $transactions->where('transactions.location_id', $location_id);
                }
            }

            if (!empty(request()->start_date) && !empty(request()->end_date)) {
                $start = request()->start_date;
                $end =  request()->end_date;
                $transactions->whereDate('transactions.transaction_date', '>=', $start)
                            ->whereDate('transactions.transaction_date', '<=', $end);
            }

            if (!empty(request()->input('created_by'))) {
                $transactions->where('transactions.created_by', request()->input('created_by'));
            }
           
            if (!empty(request()->input('assign_delivery_status'))) {
                $transactions->where('transactions.assign_delivery_status', request()->input('assign_delivery_status'));
            }
            
            $transactions->groupBy('transactions.id');
            
            $datatable = DataTables::of($transactions)
                ->addColumn('action', function ($row){
                        $html = '<div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                        data-toggle="dropdown" aria-expanded="false">' .
                                        __("messages.actions") .
                                        '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-left" role="menu">' ;

                                    if (auth()->user()->can("assign.delivery")) {
                                        $html .= '<li><a href="' . action('DeliveryController@create', [$row->id]) . '"><i class="fas fa-edit"></i>' . __("messages.assign_delivery") . '</a></li>';
                                    }

                        $html .= '</ul></div>';

                        return $html;
                    }
                )
                ->removeColumn('id')
                
                ->editColumn('transaction_date', '{{@format_datetime($transaction_date)}}')
                ->editColumn('assign_delivery_status', function($row) use($assignStatuses){
                      $status=$assignStatuses[$row->assign_delivery_status];
                      $status_color = !empty($this->assign_status_colors[$row->assign_delivery_status]) ? $this->assign_status_colors[$row->assign_delivery_status] : 'bg-gray';
                      $status ='<span class="label ' . $status_color .'">' . $assignStatuses[$row->assign_delivery_status] . '</span>';
                      return $status;
                })
        
                 ->setRowAttr([
                    'data-href' => function ($row) {
                        if ((auth()->user()->can("sell.view") || auth()->user()->can("view_own_sell_only")) && $row->type=='sell') {
                            return  action('SellController@show', [$row->id]);
                       } elseif((auth()->user()->can("purchase.view") || auth()->user()->can("view_own_purchase_only")) && $row->type=='purchase') {
                        return  action('PurchaseController@show', [$row->id]);
                        }
                        else{
                            return '';
                        }
                    }]);

            $rawColumns = ['action','transaction_date','assign_delivery_status'];  
            return $datatable->rawColumns($rawColumns)
                      ->make(true);
        } 
        $business_locations = BusinessLocation::forDropdown($business_id, false);
        $customers = Contact::customersDropdown($business_id, false);
        $sales_representative = User::forDropdown($business_id, false, false, true);
        return view('delivery.assign_index')->with(compact('business_locations','customers','sales_representative','assignStatuses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery=Delivery::findorfail($id);
        $delivery_person=$this->moduleUtil->getDeliveryUser($delivery->delivery_person_id);
        return view('delivery.partials.delivery_show',compact('delivery','delivery_person'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}
