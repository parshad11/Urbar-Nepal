<?php

namespace App\Http\Controllers;

use App\BusinessLocation;

use App\PurchaseLine;
use App\Transaction;
use App\TransactionSellLinesPurchaseLines;
use App\Utils\ModuleUtil;

use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use Datatables;
use App\User;
use App\Delivery;
use App\DeliveryPerson;
use App\Notifications\DeliveryAssignedNotification;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTransferController extends Controller
{

    /**
     * All Utils instance.
     *
     */
    protected $productUtil;
    protected $transactionUtil;
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(ProductUtil $productUtil, TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->productUtil = $productUtil;
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
        $this->status_colors = [
            'in_transit' => 'bg-yellow',
            'completed' => 'bg-green',
            'pending' => 'bg-red',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('purchase.view') && !auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $statuses  = $this->transactionUtil->stockStatuses();
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $edit_days = request()->session()->get('business.transaction_edit_days');

            $stock_transfers = Transaction::join(
                'business_locations AS l1',
                'transactions.location_id',
                '=',
                'l1.id'
            )
                ->join('transactions as t2', 't2.transfer_parent_id', '=', 'transactions.id')
                ->join(
                    'business_locations AS l2',
                    't2.location_id',
                    '=',
                    'l2.id'
                )
                ->where('transactions.business_id', $business_id)
                ->where('transactions.type', 'sell_transfer')
                ->select(
                    'transactions.id',
                    'transactions.transaction_date',
                    'transactions.ref_no',
                    'l1.name as location_from',
                    'l2.name as location_to',
                    'transactions.final_total',
                    'transactions.shipping_charges',
                    'transactions.additional_notes',
                    'transactions.id as DT_RowId',
                    'transactions.status'
                );


            return Datatables::of($stock_transfers)
                ->addColumn('action', function ($row) use ($edit_days) {
                    $html = '<button type="button" title="' . __("stock_adjustment.view_details") . '" class="btn btn-primary btn-xs btn-modal" data-container=".view_modal" data-href="' . action('StockTransferController@show', [$row->id]) . '"><i class="fa fa-eye" aria-hidden="true"></i> ' . __('messages.view') . '</button>';

                    $html .= ' <a href="#" class="print-invoice btn btn-info btn-xs" data-href="' . action('StockTransferController@printInvoice', [$row->id]) . '"><i class="fa fa-print" aria-hidden="true"></i> ' . __("messages.print") . '</a>';

                    $date = \Carbon::parse($row->transaction_date)
                        ->addDays($edit_days);
                    $today = today();

                    if ($date->gte($today)) {
                        $html .= '&nbsp;
                        <button type="button" data-href="' . action("StockTransferController@destroy", [$row->id]) . '" class="btn btn-danger btn-xs delete_stock_transfer"><i class="fa fa-trash" aria-hidden="true"></i> ' . __("messages.delete") . '</button>';
                    }

                    if ($row->status != 'final') {
                        $html .= '&nbsp;
                        <a href="' . action("StockTransferController@edit", [$row->id]) . '" class="btn btn-primary btn-xs"><i class="fa fa-edit" aria-hidden="true"></i> ' . __("messages.edit") . '</a>';
                    }

                    return $html;
                })
                ->editColumn(
                    'final_total',
                    '<span class="display_currency" data-currency_symbol="true">{{$final_total}}</span>'
                )
                ->editColumn(
                    'shipping_charges',
                    '<span class="display_currency" data-currency_symbol="true">{{$shipping_charges}}</span>'
                )
                ->editColumn('status', function ($row) use ($statuses) {
                    $row->status = $row->status == 'final' ? 'completed' : $row->status;
                    $status = $statuses[$row->status];
                    $status_color = !empty($this->status_colors[$row->status]) ? $this->status_colors[$row->status] : 'bg-gray';
                    $status = $row->status != 'completed' ? '<a href="#" class="stock_transfer_status" data-status="' . $row->status . '" data-href="' . action("StockTransferController@updateStatus", [$row->id]) . '"><span class="label ' . $status_color . '">' . $statuses[$row->status] . '</span></a>' : '<span class="label ' . $status_color . '">' . $statuses[$row->status] . '</span>';
                    return $status;
                })
                ->editColumn('transaction_date', '{{@format_datetime($transaction_date)}}')
                ->rawColumns(['final_total', 'action', 'shipping_charges', 'status'])
                ->setRowAttr([
                    'data-href' => function ($row) {
                        return action('StockTransferController@show', [$row->id]);
                    }])
                ->make(true);
        }

        return view('stock_transfer.index')->with(compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse(action('StockTransferController@index'));
        }

        $business_locations = BusinessLocation::forDropdown($business_id);

        $stock_delivery_statuses  = $this->transactionUtil->stockDeliveryStatuses();
        $statuses  = $this->transactionUtil->stockStatuses();

        return view('stock_transfer.create')
            ->with(compact('business_locations', 'statuses','stock_delivery_statuses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->except('_token');
            $business_id = $request->session()->get('user.business_id');

            //Check if subscribed or not
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse(action('StockTransferController@index'));
            }

            DB::beginTransaction();

            $input_data = $request->only(['location_id', 'ref_no', 'transaction_date', 'additional_notes', 'shipping_charges', 'final_total','assign_delivery','shipping_details']);
            $status = $request->input('status');
            $user_id = Auth::user()->id;

            $input_data['final_total'] = $this->productUtil->num_uf($input_data['final_total']);
            $input_data['total_before_tax'] = $input_data['final_total'];
            $input_data['type'] = 'sell_transfer';
            $input_data['business_id'] = $business_id;
            $input_data['created_by'] = $user_id;
            $input_data['transaction_date'] = $this->productUtil->uf_date($input_data['transaction_date'], true);
            $input_data['shipping_charges'] = $this->productUtil->num_uf($input_data['shipping_charges']);
            $input_data['payment_status'] = 'paid';
            $input_data['status'] = $status == 'completed' ? 'final' : $status;

            //Update reference count
            $ref_count = $this->productUtil->setAndGetReferenceCount('stock_transfer');
            //Generate reference number
            if (empty($input_data['ref_no'])) {
                $input_data['ref_no'] = $this->productUtil->generateReferenceNumber('stock_transfer', $ref_count);
            }

            $products = $request->input('products');
            $sell_lines = [];
            $purchase_lines = [];

            if (!empty($products)) {
                foreach ($products as $product) {
                    $sell_line_arr = [
                        'product_id' => $product['product_id'],
                        'variation_id' => $product['variation_id'],
                        'quantity' => $this->productUtil->num_uf($product['quantity']),
                        'item_tax' => 0,
                        'tax_id' => null];

                    $purchase_line_arr = $sell_line_arr;
                    $sell_line_arr['unit_price'] = $this->productUtil->num_uf($product['unit_price']);
                    $sell_line_arr['unit_price_inc_tax'] = $sell_line_arr['unit_price'];

                    $purchase_line_arr['purchase_price'] = $sell_line_arr['unit_price'];
                    $purchase_line_arr['purchase_price_inc_tax'] = $sell_line_arr['unit_price'];

                    if (!empty($product['lot_no_line_id'])) {
                        //Add lot_no_line_id to sell line
                        $sell_line_arr['lot_no_line_id'] = $product['lot_no_line_id'];

                        //Copy lot number and expiry date to purchase line
                        $lot_details = PurchaseLine::find($product['lot_no_line_id']);
                        $purchase_line_arr['lot_number'] = $lot_details->lot_number;
                        $purchase_line_arr['mfg_date'] = $lot_details->mfg_date;
                        $purchase_line_arr['exp_date'] = $lot_details->exp_date;
                    }

                    $sell_lines[] = $sell_line_arr;
                    $purchase_lines[] = $purchase_line_arr;
                }
            }

            //Create Sell Transfer transaction
            $sell_transfer = Transaction::create($input_data);

            //Create Purchase Transfer at transfer location
            $input_data['type'] = 'purchase_transfer';
            $input_data['location_id'] = $request->input('transfer_location_id');
            $input_data['transfer_parent_id'] = $sell_transfer->id;
            $input_data['status'] = $status == 'completed' ? 'received' : $status;
            $input_data['assign_delivery']=0;
            $purchase_transfer = Transaction::create($input_data);

            //Sell Product from first location
            if (!empty($sell_lines)) {
                $this->transactionUtil->createOrUpdateSellLines($sell_transfer, $sell_lines, $input_data['location_id']);
            }

            //Purchase product in second location
            if (!empty($purchase_lines)) {
                $purchase_transfer->purchase_lines()->createMany($purchase_lines);
            }

            //Decrease product stock from sell location
            //And increase product stock at purchase location
            if ($status == 'completed') {
                foreach ($products as $product) {
                    if ($product['enable_stock']) {
                        $this->productUtil->decreaseProductQuantity(
                            $product['product_id'],
                            $product['variation_id'],
                            $sell_transfer->location_id,
                            $this->productUtil->num_uf($product['quantity'])
                        );

                        $this->productUtil->updateProductQuantity(
                            $purchase_transfer->location_id,
                            $product['product_id'],
                            $product['variation_id'],
                            $product['quantity']
                        );
                    }
                }

                //Adjust stock over selling if found
                $this->productUtil->adjustStockOverSelling($purchase_transfer);

                //Map sell lines with purchase lines
                $business = ['id' => $business_id,
                    'accounting_method' => $request->session()->get('business.accounting_method'),
                    'location_id' => $sell_transfer->location_id
                ];
                $this->transactionUtil->mapPurchaseSell($business, $sell_transfer->sell_lines, 'purchase');
            }
            if($sell_transfer->assign_delivery){
                $delivery_details['transaction_id']=$sell_transfer->id;
                $delivery_details['delivery_person_id']=$request->input('delivery_person_id');
                $delivery_details['delivery_status']=$request->input('delivery_status');
                $delivery_details['shipping_address']=$purchase_transfer->location->location_address;
                $delivery_details['shipping_latitude']=$purchase_transfer->location->latitude;
                $delivery_details['shipping_longitude']=$purchase_transfer->location->longitude;
                $delivery_details['pickup_address']=$sell_transfer->location->location_address;
                $delivery_details['pickup_latitude']=$sell_transfer->location->latitude;
                $delivery_details['pickup_longitude']=$sell_transfer->location->longitude;
                $delivery_details['delivery_status']=$request->input('delivery_status');
                $delivery_details['special_delivery_instructions']=$request->input('special_delivery_instructions');
                $delivery_details['assigned_by']=$user_id;
                $delivery= Delivery::create($delivery_details);
                $delivery_person = DeliveryPerson::find($request->delivery_person_id);
                $user=User::find($delivery_person->user_id);
                $user->notify(new DeliveryAssignedNotification($delivery->record_staff->user_name,$delivery->id));
                $sell_transfer->assign_delivery_status=1;
                $sell_transfer->save();
             }

            
            $output = ['success' => 1,
                'msg' => __('lang_v1.stock_transfer_added_successfully')
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => $e->getMessage()
            ];
        }
        return redirect('stock-transfers')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('purchase.view')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $sell_transfer = Transaction::where('business_id', $business_id)
            ->where('id', $id)
            ->where('type', 'sell_transfer')
            ->with(
                'contact',
                'sell_lines',
                'sell_lines.product',
                'sell_lines.variations',
                'sell_lines.variations.product_variation',
                'sell_lines.lot_details',
                'location',
                'sell_lines.product.unit'
            )
            ->first();

        $purchase_transfer = Transaction::where('business_id', $business_id)
            ->where('transfer_parent_id', $sell_transfer->id)
            ->where('type', 'purchase_transfer')
            ->first();

        $location_details = ['sell' => $sell_transfer->location, 'purchase' => $purchase_transfer->location];

        $lot_n_exp_enabled = false;
        if (request()->session()->get('business.enable_lot_number') == 1 || request()->session()->get('business.enable_product_expiry') == 1) {
            $lot_n_exp_enabled = true;
        }

        $statuses  = $this->transactionUtil->stockStatuses();
        return view('stock_transfer.show')
            ->with(compact('sell_transfer', 'location_details', 'lot_n_exp_enabled', 'statuses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if (!auth()->user()->can('purchase.delete')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            if (request()->ajax()) {
                $edit_days = request()->session()->get('business.transaction_edit_days');
                if (!$this->transactionUtil->canBeEdited($id, $edit_days)) {
                    return ['success' => 0,
                        'msg' => __('messages.transaction_edit_not_allowed', ['days' => $edit_days])];
                }

                //Get sell transfer transaction
                $sell_transfer = Transaction::where('id', $id)
                    ->where('type', 'sell_transfer')
                    ->with(['sell_lines'])
                    ->first();

                //Get purchase transfer transaction
                $purchase_transfer = Transaction::where('transfer_parent_id', $sell_transfer->id)
                    ->where('type', 'purchase_transfer')
                    ->with(['purchase_lines'])
                    ->first();

                //Check if any transfer stock is deleted and delete purchase lines
                $purchase_lines = $purchase_transfer->purchase_lines;
                foreach ($purchase_lines as $purchase_line) {
                    if ($purchase_line->quantity_sold > 0) {
                        return ['success' => 0,
                            'msg' => __('lang_v1.stock_transfer_cannot_be_deleted')
                        ];
                    }
                }

                DB::beginTransaction();
                //Get purchase lines from transaction_sell_lines_purchase_lines and decrease quantity_sold
                $sell_lines = $sell_transfer->sell_lines;
                $deleted_sell_purchase_ids = [];
                $products = []; //variation_id as array

                foreach ($sell_lines as $sell_line) {
                    $purchase_sell_line = TransactionSellLinesPurchaseLines::where('sell_line_id', $sell_line->id)->first();

                    if (!empty($purchase_sell_line)) {
                        //Decrease quntity sold from purchase line
                        PurchaseLine::where('id', $purchase_sell_line->purchase_line_id)
                            ->decrement('quantity_sold', $sell_line->quantity);

                        $deleted_sell_purchase_ids[] = $purchase_sell_line->id;

                        //variation details
                        if (isset($products[$sell_line->variation_id])) {
                            $products[$sell_line->variation_id]['quantity'] += $sell_line->quantity;
                            $products[$sell_line->variation_id]['product_id'] = $sell_line->product_id;
                        } else {
                            $products[$sell_line->variation_id]['quantity'] = $sell_line->quantity;
                            $products[$sell_line->variation_id]['product_id'] = $sell_line->product_id;
                        }
                    }
                }

                //Update quantity available in both location
                if (!empty($products)) {
                    foreach ($products as $key => $value) {
                        //Decrease from location 2
                        $this->productUtil->decreaseProductQuantity(
                            $products[$key]['product_id'],
                            $key,
                            $purchase_transfer->location_id,
                            $products[$key]['quantity']
                        );

                        //Increase in location 1
                        $this->productUtil->updateProductQuantity(
                            $sell_transfer->location_id,
                            $products[$key]['product_id'],
                            $key,
                            $products[$key]['quantity']
                        );
                    }
                }

                //Delete sale line purchase line
                if (!empty($deleted_sell_purchase_ids)) {
                    TransactionSellLinesPurchaseLines::whereIn('id', $deleted_sell_purchase_ids)
                        ->delete();
                }
                $delivery=Delivery::where('transaction_id',$sell_transfer->id)->first();
                //Delete both transactions
                $sell_transfer->delete();
                $purchase_transfer->delete();
                if ($delivery) {
                    $delivery->delete();
                }
                $output = ['success' => 1,
                    'msg' => __('lang_v1.stock_transfer_delete_success')
                ];
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }
        return $output;
    }

    /**
     * Checks if ref_number and supplier combination already exists.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function printInvoice($id)
    {
        try {
            $business_id = request()->session()->get('user.business_id');

            $sell_transfer = Transaction::where('business_id', $business_id)
                ->where('id', $id)
                ->where('type', 'sell_transfer')
                ->with(
                    'contact',
                    'sell_lines',
                    'sell_lines.product',
                    'sell_lines.variations',
                    'sell_lines.variations.product_variation',
                    'sell_lines.lot_details',
                    'location',
                    'sell_lines.product.unit'
                )
                ->first();

            $purchase_transfer = Transaction::where('business_id', $business_id)
                ->where('transfer_parent_id', $sell_transfer->id)
                ->where('type', 'purchase_transfer')
                ->first();

            $location_details = ['sell' => $sell_transfer->location, 'purchase' => $purchase_transfer->location];

            $lot_n_exp_enabled = false;
            if (request()->session()->get('business.enable_lot_number') == 1 || request()->session()->get('business.enable_product_expiry') == 1) {
                $lot_n_exp_enabled = true;
            }


            $output = ['success' => 1, 'receipt' => []];
            $output['receipt']['html_content'] = view('stock_transfer.print', compact('sell_transfer', 'location_details', 'lot_n_exp_enabled'))->render();
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business_id = request()->session()->get('user.business_id');

        $business_locations = BusinessLocation::forDropdown($business_id);

        $sell_transfer = Transaction::where('business_id', $business_id)
            ->where('type', 'sell_transfer')
            ->where('status', '!=', 'final')
            ->with(['sell_lines'])
            ->findOrFail($id);

        $purchase_transfer = Transaction::where('business_id',
            $business_id)
            ->where('transfer_parent_id', $id)
            ->where('status', '!=', 'received')
            ->where('type', 'purchase_transfer')
            ->first();

        $products = [];
        foreach ($sell_transfer->sell_lines as $sell_line) {
            $product = $this->productUtil->getDetailsFromVariation($sell_line->variation_id, $business_id, $sell_transfer->location_id);
            $product->formatted_qty_available = $this->productUtil->num_f($product->qty_available);
            $product->quantity_ordered = $sell_line->quantity;
            $product->transaction_sell_lines_id = $sell_line->id;
            $product->lot_no_line_id = $sell_line->lot_no_line_id;

            //Get lot number dropdown if enabled
            $lot_numbers = [];
            if (request()->session()->get('business.enable_lot_number') == 1 || request()->session()->get('business.enable_product_expiry') == 1) {
                $lot_number_obj = $this->transactionUtil->getLotNumbersFromVariation($sell_line->variation_id, $business_id, $sell_transfer->location_id, true);
                foreach ($lot_number_obj as $lot_number) {
                    $lot_number->qty_formated = $this->productUtil->num_f($lot_number->qty_available);
                    $lot_numbers[] = $lot_number;
                }
            }
            $product->lot_numbers = $lot_numbers;

            $products[] = $product;
        }
       
        $stock_delivery_statuses  = $this->transactionUtil->stockDeliveryStatuses();
        $statuses  = $this->transactionUtil->stockStatuses();
        
        $main_delivery=\App\Delivery::with('delivery_person')->where('transaction_id',$id)->first();
        return view('stock_transfer.edit')
            ->with(compact('sell_transfer', 'purchase_transfer', 'business_locations', 'products',
                'statuses','stock_delivery_statuses','main_delivery'));
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
        if (!auth()->user()->can('purchase.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
        
            $business_id = $request->session()->get('user.business_id');

            //Check if subscribed or not
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse(action('StockTransferController@index'));
            }

            $business_id = request()->session()->get('user.business_id');

            $sell_transfer = Transaction::where('business_id', $business_id)
                ->where('type', 'sell_transfer')
                ->findOrFail($id);


            $purchase_transfer = Transaction::where('business_id',
                $business_id)
                ->where('transfer_parent_id', $id)
                ->where('type', 'purchase_transfer')
                ->with(['purchase_lines'])
                ->first();

            $status = $request->input('status');

            DB::beginTransaction();

                      
           
            $input_data = $request->only(['transaction_date', 'additional_notes', 'shipping_charges', 'final_total','assign_delivery','shipping_details']);
            $status = $request->input('status');

            $input_data['final_total'] = $this->productUtil->num_uf($input_data['final_total']);
            $input_data['total_before_tax'] = $input_data['final_total'];

            $input_data['transaction_date'] = $this->productUtil->uf_date($input_data['transaction_date'], true);
            $input_data['shipping_charges'] = $this->productUtil->num_uf($input_data['shipping_charges']);
            $input_data['status'] = $status == 'completed' ? 'final' : $status;

            $products = $request->input('products');
            $sell_lines = [];
            $purchase_lines = [];
            $edited_purchase_lines = [];
            if (!empty($products)) {
                foreach ($products as $product) {
                    $sell_line_arr = [
                        'product_id' => $product['product_id'],
                        'variation_id' => $product['variation_id'],
                        'quantity' => $this->productUtil->num_uf($product['quantity']),
                        'item_tax' => 0,
                        'tax_id' => null];

                    $purchase_line_arr = $sell_line_arr;
                    $sell_line_arr['unit_price'] = $this->productUtil->num_uf($product['unit_price']);
                    $sell_line_arr['unit_price_inc_tax'] = $sell_line_arr['unit_price'];

                    $purchase_line_arr['purchase_price'] = $sell_line_arr['unit_price'];
                    $purchase_line_arr['purchase_price_inc_tax'] = $sell_line_arr['unit_price'];
                    if (isset($product['transaction_sell_lines_id'])) {
                        $sell_line_arr['transaction_sell_lines_id'] = $product['transaction_sell_lines_id'];
                    }

                    if (!empty($product['lot_no_line_id'])) {
                        //Add lot_no_line_id to sell line
                        $sell_line_arr['lot_no_line_id'] = $product['lot_no_line_id'];

                        //Copy lot number and expiry date to purchase line
                        $lot_details = PurchaseLine::find($product['lot_no_line_id']);
                        $purchase_line_arr['lot_number'] = $lot_details->lot_number;
                        $purchase_line_arr['mfg_date'] = $lot_details->mfg_date;
                        $purchase_line_arr['exp_date'] = $lot_details->exp_date;
                    }

                    $sell_lines[] = $sell_line_arr;

                    $purchase_line = [];
                    //check if purchase_line for the variation exists else create new 
                    foreach ($purchase_transfer->purchase_lines as $pl) {
                        if ($pl->variation_id == $purchase_line_arr['variation_id']) {
                            $pl->update($purchase_line_arr);
                            $edited_purchase_lines[] = $pl->id;
                            $purchase_line = $pl;
                            break;
                        }
                    }
                    if (empty($purchase_line)) {
                        $purchase_line = new PurchaseLine($purchase_line_arr);
                    }

                    $purchase_lines[] = $purchase_line;
                }
            }

            if(!isset($input_data['assign_delivery'])){
                $input_data['assign_delivery']=0;
            }
            //Create Sell Transfer transaction
            $sell_transfer->update($input_data);
            $sell_transfer->save();

            //Create Purchase Transfer at transfer location
            $input_data['status'] = $status == 'completed' ? 'received' : $status;
            $input_data['assign_delivery']=0;
            $purchase_transfer->update($input_data);
            $purchase_transfer->save();
            $user_id = Auth::user()->id;
            //Sell Product from first location
            if (!empty($sell_lines)) {
                $this->transactionUtil->createOrUpdateSellLines($sell_transfer, $sell_lines, $sell_transfer->location_id);
            }

            //Purchase product in second location
            if (!empty($purchase_lines)) {
                if (!empty($edited_purchase_lines)) {
                    PurchaseLine::where('transaction_id', $purchase_transfer->id)
                        ->whereNotIn('id', $edited_purchase_lines)
                        ->delete();
                }
                $purchase_transfer->purchase_lines()->saveMany($purchase_lines);
            }

            //Decrease product stock from sell location
            //And increase product stock at purchase location
            if ($status == 'completed') {
                foreach ($products as $product) {
                    if ($product['enable_stock']) {
                        $this->productUtil->decreaseProductQuantity(
                            $product['product_id'],
                            $product['variation_id'],
                            $sell_transfer->location_id,
                            $this->productUtil->num_uf($product['quantity'])
                        );

                        $this->productUtil->updateProductQuantity(
                            $purchase_transfer->location_id,
                            $product['product_id'],
                            $product['variation_id'],
                            $product['quantity']
                        );
                    }
                }

                //Adjust stock over selling if found
                $this->productUtil->adjustStockOverSelling($purchase_transfer);

                //Map sell lines with purchase lines
                $business = ['id' => $business_id,
                    'accounting_method' => $request->session()->get('business.accounting_method'),
                    'location_id' => $sell_transfer->location_id
                ];
                $this->transactionUtil->mapPurchaseSell($business, $sell_transfer->sell_lines, 'purchase');
            }

            
            if($sell_transfer->assign_delivery){
                Delivery::updateOrCreate(
                    ['transaction_id'=>$sell_transfer->id],
                    [
                    'transaction_id'=>$sell_transfer->id,
                    'delivery_person_id'=>$request->input('delivery_person_id'),
                    'delivery_status'=>$request->input('delivery_status'),
                    'pickup_address'=>$sell_transfer->location->city,
                    'pickup_latitude'=>$sell_transfer->location->latitude,
                    'pickup_longitude'=>$sell_transfer->location->longitude,
                    'shipping_address'=>$purchase_transfer->location->city,
                    'shipping_latitude'=>$purchase_transfer->location->latitude,
                    'shipping_longitude'=>$purchase_transfer->location->longitude,
                    'special_delivery_instructions'=>$request->input('special_delivery_instructions'),
                    'assigned_by'=>$user_id,

                    ]);
                    $sell_transfer->assign_delivery_status=1;
                    $sell_transfer->save();
            }

            $output = ['success' => 1,
                'msg' => __('lang_v1.updated_succesfully')
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => $e->getMessage()
            ];
        }

        return redirect('stock-transfers')->with('status', $output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        if (!auth()->user()->can('purchase.update')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = request()->session()->get('user.business_id');

            $sell_transfer = Transaction::where('business_id', $business_id)
                ->where('type', 'sell_transfer')
                ->with(['sell_lines', 'sell_lines.product'])
                ->findOrFail($id);

            $purchase_transfer = Transaction::where('business_id',
                $business_id)
                ->where('transfer_parent_id', $id)
                ->where('type', 'purchase_transfer')
                ->with(['purchase_lines'])
                ->first();

            $status = $request->input('status');

            DB::beginTransaction();
            if ($status == 'completed' && $sell_transfer->status != 'completed') {

                foreach ($sell_transfer->sell_lines as $sell_line) {
                    if ($sell_line->product->enable_stock) {
                        $this->productUtil->decreaseProductQuantity(
                            $sell_line->product_id,
                            $sell_line->variation_id,
                            $sell_transfer->location_id,
                            $sell_line->quantity
                        );

                        $this->productUtil->updateProductQuantity(
                            $purchase_transfer->location_id,
                            $sell_line->product_id,
                            $sell_line->variation_id,
                            $sell_line->quantity,
                            0,
                            null,
                            false
                        );
                    }
                }

                //Adjust stock over selling if found
                $this->productUtil->adjustStockOverSelling($purchase_transfer);

                //Map sell lines with purchase lines
                $business = ['id' => $business_id,
                    'accounting_method' => $request->session()->get('business.accounting_method'),
                    'location_id' => $sell_transfer->location_id
                ];
                $this->transactionUtil->mapPurchaseSell($business, $sell_transfer->sell_lines, 'purchase');
            }
            $purchase_transfer->status = $status == 'completed' ? 'received' : $status;
            $purchase_transfer->save();
            $sell_transfer->status = $status == 'completed' ? 'final' : $status;
            $sell_transfer->save();

            DB::commit();

            $output = ['success' => 1,
                'msg' => __('lang_v1.updated_succesfully')
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0,
                'msg' => "File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage()
            ];
        }

        return $output;
    }
}
