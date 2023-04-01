<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\InventDetail;
use App\Product;
use App\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->name=='RootAdmin' || Auth::user()->name=='SuperAdmin'){
        $inventories = Inventory::orderBy('medicine_name','asc')->get();
        }else{
        $inventories = Inventory::where('base_name',Auth::user()->base_name)->orderBy('medicine_name','asc')->get();     
        }

        return view('inventories.index',compact('inventories'));
    }

    public function getAutoSuggestInvntryProduct(Request $request)
    {
  
      $output = '';
      $product_name = $request->input('product_name');
      $productsFound = Inventory::where('medicine_name', 'like', $product_name."%")->paginate(900);
      
      foreach ($productsFound as $productsFound){
        $output .='<option value="'.$productsFound->product_id.'">'.$productsFound->medicine_name.'  '.$productsFound->strength.'</option>';
      }
      echo $output;

    }

    public function getAutoSuggestInvntryGeneric(Request $request)
    {
  
      $outputgn = '';
      $generic_name = $request->input('generic_name');
      $productsFoundByGeneric = Inventory::where('generic_name', 'like', $generic_name."%")->paginate(900);
      
      foreach ($productsFoundByGeneric as $productsFoundByGeneric){
        $outputgn .='<option value="'.$productsFoundByGeneric->product_id.'">'.$productsFoundByGeneric->generic_name.'  '.$productsFoundByGeneric->strength.'</option>';
      }
      echo $outputgn;

    }

    public function getAutoSuggestProductId(Request $request)
    {
  
      $outputPrdId = '';
      $product_name = $request->input('product_name');
      $productsIdFound = Product::where('medicine_name', 'like', $product_name."%")->paginate(900);
      
      foreach ($productsIdFound as $productsIdFound){
        $outputPrdId .='<option value="'.$productsIdFound->id.'">'.$productsIdFound->medicine_name.'  '.$productsIdFound->strength.'</option>';
      }
      echo $outputPrdId;

    }

    public function getInvntryProductNameById(Request $request)
    {
  
      $medicine_nm = ''; $product_cat = ''; $generic_nm = ''; $strength_nm = '';

      $product_id = $request->input('product_id');
      $prodtsss = Product::where('id',$product_id)->get();
      
       foreach ($prodtsss as $prodtsss){
         $medicine_nm.= $prodtsss->medicine_name;
         $product_cat.= $prodtsss->product_category;
         $generic_nm.= $prodtsss->generic_name;
         $strength_nm.= $prodtsss->strength;
       }


       echo json_encode(array('medicine_nm' => $medicine_nm, 'product_cat' => $product_cat, 'generic_nm' => $generic_nm, 'strength_nm' => $strength_nm));

    }

    public function getInventoryProduct(Request $request)
    {
        
        $medicine_id = $request->input('medicine_name');
        $generic_id = $request->input('generic_name');
        
        $medicine_nm = ''; $medicine_gnrc_nm = ''; $medicine_strngth = '';
        $product_name_strength = Product::where('id',$medicine_id)->orWhere('id',$generic_id)->get();
        foreach ($product_name_strength as $product_name_strength){
          $medicine_nm = $product_name_strength->medicine_name;
          $medicine_gnrc_nm = $product_name_strength->generic_name;
          $medicine_strngth = $product_name_strength->strength;
        }

        if(Auth::user()->name=='RootAdmin' || Auth::user()->name=='SuperAdmin'){
            $inventories = Inventory::where('product_id',$medicine_id)->orWhere('product_id',$generic_id)->get();
        }else{         
            $inventories = Inventory::where('base_name',Auth::user()->base_name)->where('product_id',$medicine_id)->orWhere('product_id',$generic_id)->get();
        }

        return view('inventories.index',compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_product_list = DB::select(" select p.id, p.medicine_name from products p, prices s
        where p.id = s.product_id
        and s.status ='Active'
        and s.end_date is null
        and s.sales_price is not null
        order by p.medicine_name asc ");       
        return view('inventories.create',compact('active_product_list'));
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
        $medicine_name = $request->input('medicine_name');
        $product_id = $request->input('product_id');
        $product_category = $request->input('product_category');
        $generic_name = $request->input('generic_name');
        $strength = $request->input('strength');
        $quantity = $request->input('quantity');
        $expiry_date = $request->input('expiry_date');
        $chalan_invoice_no = $request->input('chalan_invoice_no');
        $base_name = $request->input('base_name');
        $remarks = $request->input('remarks');
        $updated_by = $request->input('updated_by');
        $updated_at = $request->input('updated_at');
        
        $product_count = Inventory::where('product_id',$product_id)->where('base_name',$base_name)->count();

        if($product_count > 0){
            $prev_stck_in_qty = Inventory::where('product_id',$product_id)->where('base_name',$base_name)->get();
            $stock_in_qtyyy = 0;
            foreach($prev_stck_in_qty as $prev_stck_in_qty){
            $stock_in_qtyyy = $prev_stck_in_qty->quantity;
            }
           $affected = DB::table('inventories')->where('product_id',$product_id)->where('base_name',$base_name)->update(['quantity' => $quantity + $stock_in_qtyyy,'expiry_date' => $expiry_date, 'chalan_invoice_no' => $chalan_invoice_no, 'base_name' => $base_name,'remarks' => $remarks,'updated_by' => $updated_by,'updated_at' => $updated_at]);
           $invent_detail = InventDetail::create(['medicine_name'=>$medicine_name, 'product_id'=>$product_id, 'quantity'=>$stock_in_qtyyy, 'add_remove_qty'=>$quantity, 'total_qty'=>$stock_in_qtyyy + $quantity, 'transction_type'=>'Receive', 'trnsc_time'=>date('Y-m-d H:i:s'), 'expiry_date'=>$expiry_date, 'base_name'=>$base_name, 'created_by'=>Auth::user()->name, 'created_at'=>date('Y-m-d H:i:s'), 'trigger_time'=>date('Y-m-d H:i:s')]);
        }else{
            $inventory = Inventory::create($input); 
            if($inventory){
            $invent_detail = InventDetail::create(['medicine_name'=>$medicine_name, 'product_id'=>$product_id, 'quantity'=>$quantity, 'add_remove_qty'=>0, 'total_qty'=>$quantity, 'transction_type'=>'Receive', 'trnsc_time'=>date('Y-m-d H:i:s'), 'expiry_date'=>$expiry_date, 'base_name'=>$base_name, 'created_by'=>Auth::user()->name, 'created_at'=>date('Y-m-d H:i:s'), 'trigger_time'=>date('Y-m-d H:i:s')]);
            }
        }
    
        return redirect()->route('inventories.index')
                        ->with('success','Inventory Updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        $invent_details = InventDetail::where('product_id',$inventory->product_id)->orderBy('id','desc')->get();
        $price_info = Price::where('product_id',$inventory->product_id)->where('status','Active')->where('end_date',null)->orderBy('id','desc')->get();
        return view('inventories.show',compact('inventory','invent_details','price_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit',compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $input = $request->all();
        $medicine_name = $request->input('medicine_name');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $transction_type = $request->input('transction_type');
        $add_remove_qty = $request->input('add_remove_qty');
        $expiry_date = $request->input('expiry_date');
        $base_name = $request->input('base_name');
        $remarks = $request->input('remarks');
        $updated_by = $request->input('updated_by');
        $updated_at = date('Y-m-d H:i:s');

      
        if($transction_type == 'Receive'){
        $inventry_updt = DB::table('inventories')->where('id',$inventory->id)->update(['quantity' => $quantity + $add_remove_qty, 'expiry_date' => $expiry_date, 'remarks' => $remarks,'updated_by' => $updated_by,'updated_at' => $updated_at]);
        }else{
        $inventry_updt = DB::table('inventories')->where('id',$inventory->id)->update(['quantity' => $quantity - $add_remove_qty, 'expiry_date' => $expiry_date, 'remarks' => $remarks,'updated_by' => $updated_by,'updated_at' => $updated_at]);
        }

        if($inventry_updt){
         if($transction_type == 'Receive'){
         $invent_detail = InventDetail::create(['medicine_name'=>$medicine_name, 'product_id'=>$product_id, 'quantity'=>$quantity, 'add_remove_qty'=>$add_remove_qty, 'total_qty'=>$quantity + $add_remove_qty, 'transction_type'=>$transction_type, 'trnsc_time'=>date('Y-m-d H:i:s'), 'expiry_date'=>$expiry_date, 'base_name'=>$base_name, 'inventry_tbl_id'=>$inventory->id, 'created_by'=>Auth::user()->name, 'created_at'=>date('Y-m-d H:i:s'), 'trigger_time'=>date('Y-m-d H:i:s')]);
         }else{
         $invent_detail = InventDetail::create(['medicine_name'=>$medicine_name, 'product_id'=>$product_id, 'quantity'=>$quantity, 'add_remove_qty'=>$add_remove_qty, 'total_qty'=>$quantity - $add_remove_qty, 'transction_type'=>$transction_type, 'trnsc_time'=>date('Y-m-d H:i:s'), 'expiry_date'=>$expiry_date, 'base_name'=>$base_name, 'inventry_tbl_id'=>$inventory->id, 'created_by'=>Auth::user()->name, 'created_at'=>date('Y-m-d H:i:s'), 'trigger_time'=>date('Y-m-d H:i:s')]);  
         }
        }

        return redirect()->route('inventories.index')
                        ->with('success','Medicine inventory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();  
        return redirect()->route('inventories.index')
                        ->with('success','Medicine inventory deleted successfully');
    }

}
