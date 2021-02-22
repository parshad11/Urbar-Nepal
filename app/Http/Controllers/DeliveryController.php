<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
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

    public function __construct( TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
       
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
            //

        }

            return view('delivery.index')->with(compact('business_locations','sales_representative'));
        
     
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

            if (!auth()->user()->can('direct_sell.access') && auth()->user()->can('view_own_sell_only')) {
                $transactions->where('transactions.created_by', request()->session()->get('user.id')->where('transactions.type','sell'));
            }

            if (!auth()->user()->can('purchase.view') && auth()->user()->can('view_own_purchase')) {
                $transactions->where('transactions.created_by', request()->session()->get('user.id')->whereIn('transactions.type',['purchase','sell_transfer']));
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

            if (!empty(request()->input('assigned_status'))) {
                $transactions->where('transactions.assigned_status', request()->input('assigned_status'));
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
        
                ->editColumn('invoice_no', function ($row) {
                    $invoice_no = $row->invoice_no;
                    if (!empty($row->woocommerce_order_id)) {
                        $invoice_no .= ' <i class="fab fa-wordpress text-primary no-print" title="' . __('lang_v1.synced_from_woocommerce') . '"></i>';
                    }
                    if (!empty($row->return_exists)) {
                        $invoice_no .= ' &nbsp;<small class="label bg-red label-round no-print" title="' . __('lang_v1.some_qty_returned_from_sell') .'"><i class="fas fa-undo"></i></small>';
                    }
                    if (!empty($row->is_recurring)) {
                        $invoice_no .= ' &nbsp;<small class="label bg-red label-round no-print" title="' . __('lang_v1.subscribed_invoice') .'"><i class="fas fa-recycle"></i></small>';
                    }

                    if (!empty($row->recur_parent_id)) {
                        $invoice_no .= ' &nbsp;<small class="label bg-info label-round no-print" title="' . __('lang_v1.subscription_invoice') .'"><i class="fas fa-recycle"></i></small>';
                    }

                    return $invoice_no;
                })
                ->setRowAttr([
                    'data-href' => function ($row) {
                        if (auth()->user()->can("sell.view") || auth()->user()->can("view_own_sell_only")) {
                            return  action('SellController@show', [$row->id]) ;
                        } else {
                            return '';
                        }
                    }]);

            $rawColumns = ['action', 'total_paid', 'total_remaining', 'payment_status', 'invoice_no', 'discount_amount', 'tax_amount', 'total_before_tax', 'shipping_status', 'types_of_service_name', 'payment_methods', 'return_due'];  
            return $datatable->rawColumns($rawColumns)
                      ->make(true);
        } 
        $business_locations = BusinessLocation::forDropdown($business_id, false);
        $sales_representative = User::forDropdown($business_id, false, false, true);
        $assignStatuses = $this->transactionUtil->delivery_assign_statuses();
        return view('delivery.assign_index')->with(compact('business_locations','sales_representative','assignStatuses'));
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
    public function show(Delivery $delivery)
    {
        //
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
