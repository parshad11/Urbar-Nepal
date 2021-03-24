<?php

namespace App\Http\Controllers\Front;

use App\BusinessLocation;
use App\Contact;
use App\Transaction;
use App\VariationLocationDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Front\Cart;
use App\InvoiceLayout;
use App\InvoiceScheme;
use App\Notifications\OrderCreatedNotification;
use App\User;
use App\Utils\BusinessUtil;
use App\Utils\ContactUtil;
use App\Utils\NotificationUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use App\Variation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Invoice;

class ShopController extends Controller
{
    protected $contactUtil;
    protected $transactionUtil;
    protected $productUtil;
    protected $notificationUtil;
    protected $businessUtil;

    public function __construct(ContactUtil $contactUtil, TransactionUtil $transactionUtil, ProductUtil $productUtil, NotificationUtil $notificationUtil, BusinessUtil $businessUtil)
    {
        $this->contactUtil = $contactUtil;
        $this->transactionUtil = $transactionUtil;
        $this->productUtil = $productUtil;
        $this->notificationUtil = $notificationUtil;
        $this->businessUtil = $businessUtil;
        $this->dummyPaymentLine = [
            'method' => 'cash', 'amount' => 0, 'note' => '', 'card_transaction_number' => '', 'card_number' => '', 'card_type' => '', 'card_holder_name' => '', 'card_month' => '', 'card_year' => '', 'card_security' => '', 'cheque_number' => '', 'bank_account_number' => '',
            'is_return' => 0, 'transaction_no' => ''
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->whereIn('id', $variation_location_product_ids)->get();
        $special_cat = Category::with('sub_categories')->where('name', 'like', '%special%')->where('parent_id', 0)->first();
        if ($special_cat == null) {
            $all_categories = Category::with('sub_categories')->where('parent_id', 0)->get();
        } else {
            $all_categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_cat->id)->get();
        }
        return view('ecommerce.shop')->with('products', $products)
            ->with('special_category', $special_cat)
            ->with('categories', $all_categories);
    }

    public function product($slug)
    {
        $product = Variation::with('product')->where('sub_sku', $slug)->first();
        $product_cat = $product->product->category_id;
        $location = BusinessLocation::where('name', 'freshktm')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->where('category_id', $product_cat)->whereIn('id', $variation_location_product_ids)->get();
        return view('ecommerce.product_single')->with('variation', $product)
            ->with('products', $products);
    }

    public function checkout()
    {
        $user_id = Auth::guard('customer')->user()->id;
        $cart_items = Cart::with('variation')->where('user_id', $user_id)->get();
       
        $user = Auth::guard('customer')->user();
        $total_price = Cart::where('user_id', $user_id)->sum('total_price');
//        dd($cart_items);
        if(count($cart_items)<=0){
            request()->session()->flash('error', 'Your cart is empty. Please add product into cart');
            return redirect()->route('shop');
        }
        return view('ecommerce.checkout')->with(compact('cart_items', 'user', 'total_price'));
    }

    public function categoryProduct($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->where('category_id', $category->id)->whereIn('id', $variation_location_product_ids)->get();
        $special_cat = Category::with('sub_categories')->where('name', 'like', '%special%')->where('parent_id', 0)->first();
        if ($special_cat == null) {
            $all_categories = Category::with('sub_categories')->where('parent_id', 0)->get();
        } else {
            $all_categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_cat->id)->get();
        }
        //$all_categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_cat->id)->get();
        return view('ecommerce.shop')->with('products', $products)
            ->with('special_category', $special_cat)
            ->with('categories', $all_categories);
    }

    public function subcategoryProduct($slug, $sub_cat_slug)
    {
        $category = Category::where('slug', $sub_cat_slug)->first();
        $location = BusinessLocation::where('location_id', 'BL0001')->first();
        $variation_location_product_ids = VariationLocationDetails::with('location')->where('location_id', $location->id)->pluck('product_id')->toArray();
        $products = Product::with(['product_variations.variations.product', 'unit'])->where('sub_category_id', $category->id)->whereIn('id', $variation_location_product_ids)->get();
        $special_cat = Category::with('sub_categories')->where('name', 'like', '%special%')->where('parent_id', 0)->first();
        if ($special_cat == null) {
            $all_categories = Category::with('sub_categories')->where('parent_id', 0)->get();
        } else {
            $all_categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_cat->id)->get();
        }
        //$all_categories = Category::with('sub_categories')->where('parent_id', 0)->where('id', '!=', $special_cat->id)->get();
        return view('ecommerce.shop')->with('products', $products)
            ->with('special_category', $special_cat)
            ->with('categories', $all_categories);
    }

    public function getCustomer()
    {
        $user_id = Auth::guard('customer')->user()->id;
        $customer = Contact::where('id', $user_id)->first();
        $orders = Transaction::with(['sell_lines.variations','delivery'])->where('contact_id', $user_id)->where('is_ecommerce_order',1)->get();
        return view('ecommerce.user_account')->with(compact('customer', 'orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $input = $request->except('_token');
            $location = BusinessLocation::where('location_id', 'BL0001')->first();
            $input['status'] = 'draft';
            $input['location_id'] = $location->id;
            $assign_delivery = 1;
            $user = Auth::guard('customer')->user();
            $input['contact_id'] = $user->id;
            $business_id = $user->business_id;
            $input['commission_agent'] = !empty($request->input('commission_agent')) ? $request->input('commission_agent') : null;
            $input['discount_amount'] = !empty($request->input('discount_amount')) ? $request->input('discount_amount') : null;
            $input['discount_type'] = !empty($request->input('discount_type')) ? $request->input('discount_amount') : null;
            $cart_items = json_decode($input['cart_items'], true);
            $input['cart_items'] = $cart_items;
            $invoice_total = $input['total_price'];
            $input['final_total'] = $invoice_total;
            $input['is_direct_sale'] = 1;
            $input['is_save_and_print'] = 1;
            $input['is_ecommerce_order'] = 1;
            $input['transaction_date'] = Carbon::now()->format('Y-m-d H:i:s');

            DB::beginTransaction();
            //Customer group details
            $contact_id = $user->id;
            $cg = $this->contactUtil->getCustomerGroup($business_id, $contact_id);
            $input['customer_group_id'] = (empty($cg) || empty($cg->id)) ? null : $cg->id;


            $invoice = InvoiceScheme::where('name', 'Default')->first();
            $input['invoice_scheme_id'] = $invoice->id;
            $product = [];
            $products = [];
            foreach ($cart_items as $item) {

                $product['product_type'] = $item['variation']['product']['type'];
                $product['unit_price'] = $item['variation']['default_sell_price'];
                $product['line_discount_price'] = 'fixed';
                $product['line_discount_amount'] = 0;
                $product['item_tax'] = 0;
                $product['tax_id'] = null;
                $product['sell_line_note'] = null;
                $product['lot_no_line_id'] = null;
                $product['product_id'] = $item['variation']['product']['id'];
                $product['variation_id'] = $item['variation']['id'];
                $product['enable_stock'] = $item['variation']['product']['enable_stock'];
                $product['quantity'] = $item['quantity'];
                $product['product_unit_id'] = $item['variation']['product']['unit_id'];
                $product['sub_unit_id'] = $item['variation']['product']['unit_id'];
                $product['base_unit_multiplier'] = 1;
                $product['unit_price_inc_tax'] = $item['variation']['sell_price_inc_tax'];
                array_push($products, $product);
            }

            $input['products'] = $products;
         
            if (!empty($input['products'])) {

                $transaction = $this->transactionUtil->createSellTransaction($business_id, $input, $invoice_total, 1, $assign_delivery);

                $this->transactionUtil->createOrUpdateSellLines($transaction, $input['products'], $input['location_id']);

                $is_credit_sale = isset($input['is_credit_sale']) && $input['is_credit_sale'] == 1 ? true : false;

	            $this->notificationUtil->autoSendNotification($business_id, 'new_sale', $transaction, $user);

	            $admin = User::where('user_type', 'admin')->first();

	            $admin->notify(new OrderCreatedNotification($transaction->contact->name,$transaction));
                $cart_items = Cart::where('user_id', $transaction->contact_id)->get();
                if ($cart_items) {
                    foreach ($cart_items as $item) {
                        $item->delete();
                    }
                }
                DB::commit();

                /*$msg = trans("sale.order_added");
                $output = ['success' => 1, 'msg' => $msg];*/
                $request->session()->flash('success', 'Order created successfully');

            } else {
                /*$output = [
                    'success' => 0,
                    'msg' => trans("messages.something_went_wrong")
                ];*/
                $request->session()->flash('error', 'Your cart is empty. Please add product into cart');

            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $request->session()->flash('error', 'something went wrong');
        }
        $request->session()->flash('success', 'Order created successfully');
        return redirect()->action('Front\ShopController@index');
    }

    private function receiptContent(
        $business_id,
        $location_id,
        $transaction_id,
        $printer_type = null,
        $is_package_slip = false,
        $from_pos_screen = true,
        $invoice_layout_id = null
    )
    {
        $output = [
            'is_enabled' => false,
            'print_type' => 'browser',
            'html_content' => null,
            'printer_config' => [],
            'data' => []
        ];


        $business_details = $this->businessUtil->getDetails($business_id);
        $location_details = BusinessLocation::find($location_id);

        if ($from_pos_screen && $location_details->print_receipt_on_invoice != 1) {
            return $output;
        }
        //Check if printing of invoice is enabled or not.
        //If enabled, get print type.
        $output['is_enabled'] = true;

        $invoice_layout_id = !empty($invoice_layout_id) ? $invoice_layout_id : $location_details->invoice_layout_id;
        $invoice_layout = $this->businessUtil->invoiceLayout($business_id, $location_id, $invoice_layout_id);

        //Check if printer setting is provided.
        $receipt_printer_type = is_null($printer_type) ? $location_details->receipt_printer_type : $printer_type;

        $receipt_details = $this->transactionUtil->getReceiptDetails($transaction_id, $location_id, $invoice_layout, $business_details, $location_details, $receipt_printer_type);

        $currency_details = [
            'symbol' => $business_details->currency_symbol,
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator' => $business_details->decimal_separator,
        ];
        $receipt_details->currency = $currency_details;

        if ($is_package_slip) {
            $output['html_content'] = view('sale_pos.receipts.packing_slip', compact('receipt_details'))->render();
            return $output;
        }
        //If print type browser - return the content, printer - return printer config data, and invoice format config
        if ($receipt_printer_type == 'printer') {
            $output['print_type'] = 'printer';
            $output['printer_config'] = $this->businessUtil->printerConfig($business_id, $location_details->printer_id);
            $output['data'] = $receipt_details;
        } else {
            $layout = !empty($receipt_details->design) ? 'sale_pos.receipts.' . $receipt_details->design : 'sale_pos.receipts.classic';

            $output['html_content'] = view($layout, compact('receipt_details'))->render();
        }

        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
