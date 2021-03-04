<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\Contact;
use App\Delivery;
use App\Transaction;
use App\User;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $deliveryStatuses = $this->transactionUtil->deliveryStatuses();
    
        if ($request->ajax()) {
           
            $deliveries = $this->transactionUtil->getDeliveries($business_id);

            if (request()->has('assigned_by')) {
                $assigned_by = request()->get('assigned_by');
                if (!empty($created_by)) {
                    $deliveries->where('deliveries.assigned_by', $assigned_by);
                }
            }

            if (!empty(request()->delivery_person_id)) {
                $delivery_person_id = request()->delivery_person_id;
                $deliveries->where('deliveries_person_id', $delivery_person_id);
            }

            if (request()->has('location_id')) {
                $location_id = request()->get('location_id');
                if (!empty($location_id)) {
                    $deliveries->where('transactions.location_id', $location_id);
                }
            }

            if (!empty(request()->start_date) && !empty(request()->end_date)) {
                $start = request()->start_date;
                $end =  request()->end_date;
                $deliveries->whereDate('deliveries.created_at', '>=', $start)
                            ->whereDate('deliveries.created_at', '<=', $end);
            }

           
            if (!empty(request()->input('delivery_status'))) {
                $deliveries->where('deliveries.delivery_status', request()->input('delivery_status'));
            }

            return Datatables::of($deliveries)
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
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make(true);
//
        } else {
            $sales_representative = User::forDropdown($business_id, false, false, true);
            $business_locations = BusinessLocation::forDropdown($business_id, false);
            return view('delivery.index')->with(compact('deliveryStatuses','business_locations','sales_representative'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($transactionId)
    {
        if (!auth()->user()->can('assign.delivery')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $deliveryStatuses  = $this->transactionUtil->deliveryStatuses();
        $transaction=Transaction::where('business_id', $business_id)
                                    ->where('id', $transactionId)
                                    ->with(
                                        'contact',
                                        'location'
                                    )
                                    ->first();
         return view('delivery.assign')
             ->with(compact('transaction', 'deliveryStatuses'));
        
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
        if (!auth()->user()->can('delivery.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->except('_token');

            $business_id = $request->session()->get('user.business_id');
            $user_id = $request->session()->get('user.id');
            DB::beginTransaction();
                $delivery=Delivery::create([
                    'transaction_id' => $input['transaction_id'],
                    'delivery_person_id' => $input['delivery_person_id'],
                    'delivery_status' => $input['delivery_status'],
                    'shipping_address' => $input['shipping_address'],
                    'shipping_latitude' => $input['shipping_latitude'],
                    'shipping_longitude' => $input['shipping_longitude'],
                    'pickup_address' => $input['pickup_address'],
                    'pickup_latitude' => $input['pickup_latitude'],
                    'pickup_longitude' => $input['pickup_longitude'],
                    'delivered_to' => $input['delivered_to'],
                    'assigned_by' => $user_id,
                    'special_delivery_instructions' => $input['special_delivery_instructions'],
                ]);
                if(isset($delivery)){
                   $transaction=Transaction::findOrFail($input['transaction_id']);
                   $transaction->assign_delivery_status=1;
                   $transaction->save();
                 }
            DB::commit();

            $output = ['success' => 1,
                            'msg' => __('delivery.delivery_assign_success')
                        ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];
        }

        return redirect('delivery-transaction')->with('status', $output);

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
