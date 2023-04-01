<?php

namespace App\Http\Controllers;

use App\Product;
use App\Price;
use App\Sale;
use App\SaleDetail;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        if(Auth::user()->name=='RootAdmin' || Auth::user()->name=='SuperAdmin'){
            $sales = Sale::orderBy('id','desc')->get();
            }else{
            $sales = Sale::where('base_name',Auth::user()->base_name)->orderBy('id','desc')->get();
            }

        return view('sales.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock_list = DB::table('inventories')->select('inventories.id','inventories.medicine_name','inventories.product_id','inventories.strength')->where('base_name',Auth::user()->base_name)->where('quantity', '>', 'stock_out_quantity')->where('expiry_date', '>', now())->orderby('medicine_name','asc')->get();
        return view('sales.create',compact('stock_list'));
    }

    public function getprice(Request $request)
    {
    $product_id = $request->input('product_id');
    $price = Price::where('product_id',$product_id)->where('end_date',null)->where('status','Active')->first();
    return $price;
    //echo $price['sales_price'];
    //echo $price['discount_rate'];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $sales = Sale::create($input);
    
        return redirect()->route('sales.index')
                        ->with('success','Sale created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        $sales_details = SaleDetail::where('sales_id',$id)->orderBy('id','desc')->get();
        return view('sales.show',compact('sale','sales_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $stock_list = DB::table('inventories')->select('inventories.id','inventories.medicine_name')->orderby('medicine_name','asc')->get();
        return view('products.edit',compact('product','stock_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return redirect()->route('sales.index')
                        ->with('success','Sales updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')
                        ->with('success','Sales deleted successfully');
    }
    

    public function orderStore(Request $request)
    {
         $data_medicine = $request->input('data_medicine');
         $data_product_id = $request->input('data_product_id');
         $data_price_id = $request->input('data_price_id');
         $data_quantity = $request->input('data_quantity');
         $data_purchase_price = $request->input('data_purchase_price');
         $data_sales_prcie = $request->input('data_sales_prcie');
         $data_discount_rate = $request->input('data_discount_rate');
         $data_total_price = $request->input('data_total_price');

         $customer_name = $request->input('customer_name');
         $customer_mobile = $request->input('customer_mobile');
         $doctor_name = $request->input('doctor_name');
         $total_sales_amount = $request->input('total_sales_amount');
         $total_discount_amnt = $request->input('total_discount_amnt');
         $total_payable_amount = $total_sales_amount - $total_discount_amnt;
         $base_name = Auth::user()->base_name;
         $created_by = Auth::user()->name;


         $sales = Sale::create(['customer_name'=>$customer_name,'customer_mobile'=>$customer_mobile, 'doctor_name'=>$doctor_name, 'total_sales_amount'=>$total_sales_amount,'total_discount_amnt'=>$total_discount_amnt, 'total_payable_amount'=>$total_payable_amount, 'base_name'=>$base_name,'created_by'=>$created_by]);
         $sales_id = $sales->id;

         for($i=0;$i<count($data_medicine);$i++)
         {
           $grand_data[]=[
             'sales_id' =>$sales_id,
             'medicine_name' =>$data_medicine[$i],
             'product_id' =>$data_product_id[$i],
             'price_id' =>$data_price_id[$i],
             'quantity' =>$data_quantity[$i],
             'purchase_price' =>$data_purchase_price[$i],
             'sales_price' =>$data_sales_prcie[$i],
             'discount_rate' =>$data_discount_rate[$i],
             'sales_amount' =>$data_total_price[$i],
             'discount' =>$data_quantity[$i] * $data_discount_rate[$i],
             'base_name' =>Auth::user()->base_name,
             'created_by' =>Auth::user()->name,
             'created_at' =>date('Y-m-d H:i:s'),
             'updated_at' =>date('Y-m-d H:i:s')
           ];
         }
      
         $sales_details = SaleDetail::insert($grand_data);
      
         if($sales_details){
            for($i=0;$i<count($data_medicine);$i++)
            {
               $prev_stck_out_qty = Inventory::where('product_id',$data_product_id[$i])->where('base_name',Auth::user()->base_name)->get();
               $stock_out_qtyyy = 0;
               foreach($prev_stck_out_qty as $prev_stck_out_qty){
                $stock_out_qtyyy = $prev_stck_out_qty->stock_out_quantity;
               }
               $affected = DB::table('inventories')->where('product_id',$data_product_id[$i])->where('base_name',Auth::user()->base_name)->update(['stock_out_quantity' => $data_quantity[$i] + $stock_out_qtyyy]);
            }
         }

         if($sales_details)
         {
            // echo 'Thanks for your Payment!!!!';
            return response()->json([
                'sales_id' => $sales_id,
                'message' => 'Thanks for your Payment!!!!',
            ]);
         }
    }

    
}
