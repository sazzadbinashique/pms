<?php

namespace App\Http\Controllers;

use App\Models\Pfi;
use App\Product;
use App\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth()->user();
            $medicine_id = $request->medicine_name;
            $generic_id = $request->generic_name;

            if ($medicine_id || $generic_id){
                $medicine_nm = ''; $medicine_gnrc_nm = ''; $medicine_strngth = '';
                $product_name_strengths= Product::where('id',$medicine_id)->orWhere('id',$generic_id)->get();
                foreach ($product_name_strengths as $product_name_strength){
                    $medicine_nm = $product_name_strength->medicine_name;
                    $medicine_gnrc_nm = $product_name_strength->generic_name;
                    $medicine_strngth = $product_name_strength->strength;
                }
                $data = Product::where('medicine_name',$medicine_nm)->Where('generic_name',$medicine_gnrc_nm)->Where('strength',$medicine_strngth)->get();
            }else{
                $data = Product::orderBy('medicine_name','asc')->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use($user){
                    $btn = '<div class="d-grid gap-2 d-md-flex justify-content-center">';
                    $btn=$btn.' <a class="btn btn-info text-white btn-sm" href="'. \URL::route('products.show',$row->id) . '">Details</a>';
                    if($user->can('product-list-edit')){
                        $btn=$btn.' <a class="btn btn-primary btn-sm" href="'. \URL::route('products.edit',$row->id) . '">Edit</a>';
                    }
                    if ($user->can('product-list-delete')){
                        $btn=$btn.'<form action="' . \URL::route('products.destroy', $row->id) . '" method="post">
                                         ' . csrf_field() . '
                                         ' . method_field('DELETE') . '
                                         <button class="btn btn-danger text-white btn-sm" type="submit"  onclick="return confirm('. "Are you sure you want to Delete this?" . ')">Delete</button>
                                    </form>';
                    }
                    $btn=$btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }

    public function getAutoSuggestProduct(Request $request)
    {

      $output = '';
      $product_name = $request->input('product_name');
      $productsFound = Product::where('medicine_name', 'like', $product_name."%")->paginate(900);

      foreach ($productsFound as $productsFound){
        $output .='<option value="'.$productsFound->id.'">'.$productsFound->medicine_name.'  '.$productsFound->strength.'</option>';
      }
      echo $output;

    }

    public function getAutoSuggestGeneric(Request $request)
    {

      $outputgn = '';
      $generic_name = $request->input('generic_name');
      $productsFoundByGeneric = Product::where('generic_name', 'like', $generic_name."%")->paginate(900);

      foreach ($productsFoundByGeneric as $productsFoundByGeneric){
        $outputgn .='<option value="'.$productsFoundByGeneric->id.'">'.$productsFoundByGeneric->generic_name.'  '.$productsFoundByGeneric->strength.'</option>';
      }
      echo $outputgn;

    }


    public function getUniqueProduct(Request $request){
        if ($request->ajax()) {
            $user = Auth()->user();
            $medicine_id = $request->input('medicine_name');
            $generic_id = $request->input('generic_name');

            $medicine_nm = ''; $medicine_gnrc_nm = ''; $medicine_strngth = '';
            $product_name_strengths= Product::where('id',$medicine_id)->orWhere('id',$generic_id)->get();
            foreach ($product_name_strengths as $product_name_strength){
                $medicine_nm = $product_name_strength->medicine_name;
                $medicine_gnrc_nm = $product_name_strength->generic_name;
                $medicine_strngth = $product_name_strength->strength;
            }

            $data = Product::where('medicine_name',$medicine_nm)->Where('generic_name',$medicine_gnrc_nm)->Where('strength',$medicine_strngth)->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use($user){
                    $btn = '<div class="d-grid gap-2 d-md-flex justify-content-center">';
                    $btn=$btn.' <a class="btn btn-info text-white btn-sm" href="'. \URL::route('products.show',$row->id) . '">Details</a>';
                    if($user->can('product-list-edit')){
                        $btn=$btn.' <a class="btn btn-primary btn-sm" href="'. \URL::route('products.edit',$row->id) . '">Edit</a>';
                    }
                    if ($user->can('product-list-delete')){
                        $btn=$btn.'<form action="' . \URL::route('products.destroy', $row->id) . '" method="post">
                                         ' . csrf_field() . '
                                         ' . method_field('DELETE') . '
                                         <button class="btn btn-danger text-white btn-sm" type="submit"  onclick="return confirm('. "Are you sure you want to Delete this?" . ')">Delete</button>
                                    </form>';
                    }
                    $btn=$btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicine_cat = DB::table('medicine_categories')->select('medicine_categories.id','medicine_categories.category_name')->orderby('category_name','asc')->get();
        return view('products.create',compact('medicine_cat'));
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

        $product_code = $request->input('product_code');
        $product_category = $request->input('product_category');
        $product_group = $request->input('product_group');
        $medicine_name = $request->input('medicine_name');
        $generic_name = $request->input('generic_name');
        $base_name = $request->input('base_name');
        $remarks = $request->input('remarks');
        $created_by = Auth::user()->name;

        $purchase_price = $request->input('purchase_price');
        $sales_price = $request->input('sales_price');
        $discount_rate = $request->input('discount_rate');
        $vat_rate = $request->input('vat_rate');
        $start_date = $request->input('start_date');




        $product = Product::create(['product_code'=>$product_code,'product_category'=>$product_category,'product_group'=>$product_group,'medicine_name'=>$medicine_name,'generic_name'=>$generic_name,'base_name'=>$base_name,'remarks'=>$remarks,'created_by'=>$created_by]);
        $product_id = $product->id;


        $price_data[]=[
            'product_id' =>$product_id,
            'medicine_name' =>$medicine_name,
            'purchase_price' =>$purchase_price,
            'sales_price' =>$sales_price,
            'discount_rate' =>$discount_rate,
            'vat_rate' =>$vat_rate,
            'start_date' =>$start_date,
            'status' =>'Active',
            'base_name' =>$base_name,
            'created_by' => $created_by,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
          ];

        $prices = Price::insert($price_data);

        return redirect()->route('products.index')
                        ->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $current_price = Price::where('product_id',$product->id)->where('end_date',null)->where('status','Active')->get();
        $price_dtls = Price::where('product_id',$product->id)->orderBy('id','desc')->get();
        return view('products.show',compact('product','current_price','price_dtls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $medicine_cat = DB::table('medicine_categories')->select('medicine_categories.id','medicine_categories.category_name')->orderby('category_name','asc')->get();
        $product_price = DB::select(" SELECT prices.id, prices.medicine_name, prices.product_id,prices.purchase_price,
        prices.sales_price, prices.discount_rate, prices.vat_rate, prices.start_date, prices.end_date
        FROM products, prices
        where products.id = prices.product_id
        and prices.status ='Active'
        and prices.end_date is null
        and prices.product_id = $product->id
            ");
        return view('products.edit',compact('product','product_price','medicine_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product_id = $product->id;
        $product_code = $request->input('product_code');
        $product_category = $request->input('product_category');
        $product_group = $request->input('product_group');
        $medicine_name = $request->input('medicine_name');
        $generic_name = $request->input('generic_name');
        $base_name = $request->input('base_name');
        $remarks = $request->input('remarks');
        $updated_by = Auth::user()->name;


        $purchase_price_old = $request->input('purchase_price_old');
        $sales_price_old = $request->input('sales_price_old');
        $discount_rate_old = $request->input('discount_rate_old');
        $vat_rate_old = $request->input('vat_rate_old');

        $purchase_price = $request->input('purchase_price');
        $sales_price = $request->input('sales_price');
        $discount_rate = $request->input('discount_rate');
        $vat_rate = $request->input('vat_rate');



        $updt_affected = DB::table('products')->where('id',$product_id)->update(['product_category' => $product_category, 'product_group' => $product_group, 'generic_name' => $generic_name, 'remarks' => $remarks, 'updated_by' => $updated_by,'updated_at' => date('Y-m-d H:i:s')]);

        if(($purchase_price != $purchase_price_old) || ($sales_price != $sales_price_old) || ($discount_rate != $discount_rate_old) || ($vat_rate != $vat_rate_old) ){
            $updt_affected = DB::table('prices')->where('product_id',$product_id)->where('end_date',null)->where('status','Active')->update(['end_date' => date('Y-m-d H:i:s'), 'status' => 'Inactive', 'updated_by' => $updated_by,'updated_at' => date('Y-m-d H:i:s')]);

         }

         if(($purchase_price != $purchase_price_old) || ($sales_price != $sales_price_old) || ($discount_rate != $discount_rate_old) || ($vat_rate != $vat_rate_old) ){

            $price_data[]=[
                'product_id' =>$product_id,
                'medicine_name' =>$medicine_name,
                'purchase_price' =>$purchase_price,
                'sales_price' =>$sales_price,
                'discount_rate' =>$discount_rate,
                'vat_rate' =>$vat_rate,
                'start_date' =>date('Y-m-d H:i:s'),
                'status' =>'Active',
                'base_name' =>$base_name,
                'created_by' => Auth::user()->name,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s')
              ];

            $prices = Price::insert($price_data);
         }

        //$product->update($request->all());
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

}
