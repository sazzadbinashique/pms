<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Inventory;
use App\InventDetail;
use App\Product;
use App\Price;
use App\Sale;
use App\SaleDetail;
use DB;
use Auth;


class ReportController extends Controller
{

    public function stock_available_report(Request $request)
    {
        $searchchk = 0;
        $stock_available_products = DB::select(" select i.medicine_name, p.product_group, p.product_category,
        p.generic_name, i.created_at, i.expiry_date, i.quantity, i.stock_out_quantity, i.base_name FROM inventories i, 
        products p where i.product_id = p.id and coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) order by i.medicine_name asc ");

        $stock_available_prod_name = DB::select(" select distinct i.medicine_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) order by i.medicine_name asc ");
        $stock_available_prod_generic_name = DB::select(" select distinct p.generic_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) order by p.generic_name asc ");
        $stock_available_prod_grp = DB::select(" select distinct p.product_group FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) order by p.product_group asc ");
        $stock_available_prod_catg = DB::select(" select distinct p.product_category FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) order by p.product_category asc ");

        return view('reports.stock_available_report',compact('stock_available_products','stock_available_prod_name','stock_available_prod_generic_name','stock_available_prod_grp','stock_available_prod_catg','searchchk'));
    }


    public function search_stock_available(Request $request){

        $base_name = $request->input('base_name');
        $product_group = $request->input('product_group');      
        $product_category = $request->input('product_category');
        $medicine_name = $request->input('medicine_name');
        $generic_name = $request->input('generic_name');
        $searchchk = 1;

        if($base_name){
            $base_name = "'".$request->input('base_name')."'";
        }else{
            $base_name = 'i.base_name';
        }

        if($product_group){
            $product_group = "'".$request->input('product_group')."'";
        }else{
            $product_group = 'p.product_group';
        }

        if($product_category){
            $product_category = "'".$request->input('product_category')."'";
        }else{
            $product_category = 'p.product_category';
        }

        if($medicine_name){
            $medicine_name = "'".$request->input('medicine_name')."'";
        }else{
            $medicine_name = 'i.medicine_name';
        }

        if($generic_name){
            $generic_name = "'".$request->input('generic_name')."'";
        }else{
            $generic_name = 'p.generic_name';
        }
    

        if($base_name || $product_group || $product_category || $medicine_name || $generic_name){

            $stock_available_products = DB::select("  select i.medicine_name, p.product_group, p.product_category,
            p.generic_name, i.created_at, i.expiry_date, i.quantity, i.stock_out_quantity, i.base_name
            FROM inventories i, products p
            where i.product_id = p.id
            and coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0)
            and (i.base_name = $base_name or i.base_name is null)
            and (p.product_group = $product_group or p.product_group is null)
            and (p.product_category = $product_category or p.product_category is null)
            and (i.medicine_name = $medicine_name or i.medicine_name is null)
            and (p.generic_name = $generic_name or p.generic_name is null)
            order by i.medicine_name asc ");

        }else{
            $stock_available_products = Product::query()->where('medicine_name','falseSearch')->get();
        }
        
        $stock_available_prod_name = DB::select(" select distinct i.medicine_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by i.medicine_name asc ");
        $stock_available_prod_generic_name = DB::select(" select distinct p.generic_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.generic_name asc ");
        $stock_available_prod_grp = DB::select(" select distinct p.product_group FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.product_group asc ");
        $stock_available_prod_catg = DB::select(" select distinct p.product_category FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.product_category asc ");

        return view('reports.stock_available_report', compact('stock_available_products','stock_available_prod_name','stock_available_prod_generic_name','stock_available_prod_grp','stock_available_prod_catg','searchchk'));
       
    }


    public function stock_unavailable_report(Request $request)
    {
        $searchchk = 0;
        $stock_unavailable_products = DB::select(" select i.medicine_name, p.product_group, p.product_category,
        p.generic_name, i.created_at, i.expiry_date, i.quantity, i.stock_out_quantity, i.base_name FROM inventories i, 
        products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by i.medicine_name asc ");

        $stock_unavailable_prod_name = DB::select(" select distinct i.medicine_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by i.medicine_name asc ");
        $stock_unavailable_prod_generic_name = DB::select(" select distinct p.generic_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.generic_name asc ");
        $stock_unavailable_prod_grp = DB::select(" select distinct p.product_group FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.product_group asc ");
        $stock_unavailable_prod_catg = DB::select(" select distinct p.product_category FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.product_category asc ");

        return view('reports.stock_unavailable_report',compact('stock_unavailable_products','stock_unavailable_prod_name','stock_unavailable_prod_generic_name','stock_unavailable_prod_grp','stock_unavailable_prod_catg','searchchk'));
    }

    
    public function search_stock_unavailable(Request $request){
        
        $base_name = $request->input('base_name');
        $product_group = $request->input('product_group');      
        $product_category = $request->input('product_category');
        $medicine_name = $request->input('medicine_name');
        $generic_name = $request->input('generic_name');
        $searchchk = 1;

        if($base_name){
            $base_name = "'".$request->input('base_name')."'";
        }else{
            $base_name = 'i.base_name';
        }

        if($product_group){
            $product_group = "'".$request->input('product_group')."'";
        }else{
            $product_group = 'p.product_group';
        }

        if($product_category){
            $product_category = "'".$request->input('product_category')."'";
        }else{
            $product_category = 'p.product_category';
        }

        if($medicine_name){
            $medicine_name = "'".$request->input('medicine_name')."'";
        }else{
            $medicine_name = 'i.medicine_name';
        }

        if($generic_name){
            $generic_name = "'".$request->input('generic_name')."'";
        }else{
            $generic_name = 'p.generic_name';
        }
    

        if($base_name || $product_group || $product_category || $medicine_name || $generic_name){

            $stock_unavailable_products = DB::select("  select i.medicine_name, p.product_group, p.product_category,
            p.generic_name, i.created_at, i.expiry_date, i.quantity, i.stock_out_quantity, i.base_name
            FROM inventories i, products p
            where i.product_id = p.id
            and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0)
            and (i.base_name = $base_name or i.base_name is null)
            and (p.product_group = $product_group or p.product_group is null)
            and (p.product_category = $product_category or p.product_category is null)
            and (i.medicine_name = $medicine_name or i.medicine_name is null)
            and (p.generic_name = $generic_name or p.generic_name is null)
            order by i.medicine_name asc ");

        }else{
            $stock_unavailable_products = Product::query()->where('medicine_name','falseSearch')->get();
        }
        
        $stock_unavailable_prod_name = DB::select(" select distinct i.medicine_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by i.medicine_name asc ");
        $stock_unavailable_prod_generic_name = DB::select(" select distinct p.generic_name FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.generic_name asc ");
        $stock_unavailable_prod_grp = DB::select(" select distinct p.product_group FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.product_group asc ");
        $stock_unavailable_prod_catg = DB::select(" select distinct p.product_category FROM inventories i, products p where i.product_id = p.id and coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) order by p.product_category asc ");

        return view('reports.stock_unavailable_report', compact('stock_unavailable_products','stock_unavailable_prod_name','stock_unavailable_prod_generic_name','stock_unavailable_prod_grp','stock_unavailable_prod_catg','searchchk'));
       
    }


    public function date_expired_report(Request $request)
    {
        $searchchk = 0;
        $date_expired_products = DB::select(" select i.medicine_name, p.product_group, p.product_category,
        p.generic_name, i.created_at, i.expiry_date, i.quantity, i.stock_out_quantity, i.base_name FROM inventories i, 
        products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by i.medicine_name asc ");

        $date_expired_prod_name = DB::select(" select distinct i.medicine_name FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by i.medicine_name asc ");
        $date_expired_prod_generic_name = DB::select(" select distinct p.generic_name FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by p.generic_name asc ");
        $date_expired_prod_grp = DB::select(" select distinct p.product_group FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by p.product_group asc ");
        $date_expired_prod_catg = DB::select(" select distinct p.product_category FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by p.product_category asc ");

        return view('reports.date_expired_report',compact('date_expired_products','date_expired_prod_name','date_expired_prod_generic_name','date_expired_prod_grp','date_expired_prod_catg','searchchk'));
    }

    
    public function search_date_expired_product(Request $request){
        
        $base_name = $request->input('base_name');
        $product_group = $request->input('product_group');      
        $product_category = $request->input('product_category');
        $medicine_name = $request->input('medicine_name');
        $generic_name = $request->input('generic_name');
        $searchchk = 1;

        if($base_name){
            $base_name = "'".$request->input('base_name')."'";
        }else{
            $base_name = 'i.base_name';
        }

        if($product_group){
            $product_group = "'".$request->input('product_group')."'";
        }else{
            $product_group = 'p.product_group';
        }

        if($product_category){
            $product_category = "'".$request->input('product_category')."'";
        }else{
            $product_category = 'p.product_category';
        }

        if($medicine_name){
            $medicine_name = "'".$request->input('medicine_name')."'";
        }else{
            $medicine_name = 'i.medicine_name';
        }

        if($generic_name){
            $generic_name = "'".$request->input('generic_name')."'";
        }else{
            $generic_name = 'p.generic_name';
        }
    

        if($base_name || $product_group || $product_category || $medicine_name || $generic_name){

            $date_expired_products = DB::select("  select i.medicine_name, p.product_group, p.product_category,
            p.generic_name, i.created_at, i.expiry_date, i.quantity, i.stock_out_quantity, i.base_name
            FROM inventories i, products p
            where i.product_id = p.id
            and date(i.expiry_date) <= curdate()
            and (i.base_name = $base_name or i.base_name is null)
            and (p.product_group = $product_group or p.product_group is null)
            and (p.product_category = $product_category or p.product_category is null)
            and (i.medicine_name = $medicine_name or i.medicine_name is null)
            and (p.generic_name = $generic_name or p.generic_name is null)
            order by i.medicine_name asc ");

        }else{
            $date_expired_products = Product::query()->where('medicine_name','falseSearch')->get();
        }
        
        $date_expired_prod_name = DB::select(" select distinct i.medicine_name FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by i.medicine_name asc ");
        $date_expired_prod_generic_name = DB::select(" select distinct p.generic_name FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by p.generic_name asc ");
        $date_expired_prod_grp = DB::select(" select distinct p.product_group FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by p.product_group asc ");
        $date_expired_prod_catg = DB::select(" select distinct p.product_category FROM inventories i, products p where i.product_id = p.id and date(i.expiry_date) <= curdate() order by p.product_category asc ");

        return view('reports.date_expired_report', compact('date_expired_products','date_expired_prod_name','date_expired_prod_generic_name','date_expired_prod_grp','date_expired_prod_catg','searchchk'));
       
    }


    public function datewise_sales_report(Request $request)
    {
        $searchchk = 0;
        $base_name = ''; $from_date = ''; $to_date = ''; $sub_total_sales = ''; $sub_total_discount = ''; $sub_total_payable = '';
        $datewise_sales_report = DB::select(" select s.customer_name, s.customer_mobile, s.total_sales_amount, s.total_discount_amnt, s.total_payable_amount, s.created_at,
        (select group_concat(d.medicine_name separator ', ') from sale_details d where d.sales_id = s.id group by d.sales_id)product_details,
        (select sum(d.quantity) from sale_details d where d.sales_id = s.id group by d.sales_id)total_qty,
        (select d.base_name from sale_details d where d.sales_id = s.id group by d.base_name)base_name
        from sales s order by created_at desc ");

        return view('reports.datewise_sales_report',compact('datewise_sales_report','searchchk','base_name','from_date','to_date','sub_total_sales','sub_total_discount','sub_total_payable'));
    }

    
    public function search_datewise_sales_report(Request $request){
        
        $base_name = $request->input('base_name');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $searchchk = 1;

        if($base_name){
            $base_name = "'".$request->input('base_name')."'";
        }else{
            $base_name = 's.base_name';
        }

        if($from_date && $to_date){
            $from_date = "'".$request->input('from_date')."'";
        }else{
            $from_date = "'".'2023-01-01'."'";
        }

        if($to_date){
            $to_date = "'".$request->input('to_date')."'";
        }else{
            $to_date = "'".'2024-12-12'."'";
        }
        
        if($base_name || $from_date || $to_date){

            $datewise_sales_report = DB::select(" select s.customer_name, s.customer_mobile, s.total_sales_amount, s.total_discount_amnt, s.total_payable_amount, s.created_at,
            (select group_concat(d.medicine_name separator ', ') from sale_details d where d.sales_id = s.id group by d.sales_id)product_details,
            (select sum(d.quantity) from sale_details d where d.sales_id = s.id group by d.sales_id)total_qty,
            (select d.base_name from sale_details d where d.sales_id = s.id group by d.base_name)base_name
            from sales s
            where (s.base_name = $base_name or s.base_name is null)
            and (date(s.created_at) >= $from_date or s.created_at is null)
            and (date(s.created_at) <= $to_date or s.created_at is null)
            ");

        }else{
            $datewise_sales_report = Sale::query()->where('medicine_name','falseSearch')->get();
        }
        

        return view('reports.datewise_sales_report', compact('datewise_sales_report','searchchk','base_name','from_date','to_date'));
       
    }


    public function datewise_purchase_report(Request $request)
    {
        $searchchk = 0;
        $base_name = ''; $from_date = ''; $to_date = ''; $sub_total_purchase = '';
        $datewise_purchase_report = DB::select(" select i.medicine_name, i.product_category, i.generic_name, i.strength, i.quantity,
        (select p.purchase_price from prices p where i.product_id = p.product_id)purchase_price_per_unit,
        (select p.purchase_price * i.quantity from prices p where i.product_id = p.product_id)purchase_price_total,
        i.base_name, i.created_at
        FROM inventories i ORDER by i.created_at desc ");

        return view('reports.datewise_purchase_report',compact('datewise_purchase_report','searchchk','base_name','from_date','to_date','sub_total_purchase'));
    }


    public function search_datewise_purchase_report(Request $request){
        
        $base_name = $request->input('base_name');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $searchchk = 1;

        if($base_name){
            $base_name = "'".$request->input('base_name')."'";
        }else{
            $base_name = 'i.base_name';
        }

        if($from_date && $to_date){
            $from_date = "'".$request->input('from_date')."'";
        }else{
            $from_date = "'".'2023-01-01'."'";
        }

        if($to_date){
            $to_date = "'".$request->input('to_date')."'";
        }else{
            $to_date = "'".'2024-12-12'."'";
        }
        
        if($base_name || $from_date || $to_date){

            $datewise_purchase_report = DB::select(" select i.medicine_name, i.product_category, i.generic_name, i.strength, i.quantity,
            (select p.purchase_price from prices p where i.product_id = p.product_id)purchase_price_per_unit,
            (select p.purchase_price * i.quantity from prices p where i.product_id = p.product_id)purchase_price_total,
            i.base_name, i.created_at
            FROM inventories i
            where (i.base_name = $base_name or i.base_name is null)
            and (date(i.created_at) >= $from_date or i.created_at is null)
            and (date(i.created_at) <= $to_date or i.created_at is null)
            ");

        }else{
            $datewise_purchase_report = Inventory::query()->where('medicine_name','falseSearch')->get();
        }
        

        return view('reports.datewise_purchase_report', compact('datewise_purchase_report','searchchk','base_name','from_date','to_date'));
       
    }

}
