<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $net_sales = DB::select(" select sum(total_payable_amount)total_payable_amount from sales ");

        $net_purchase = DB::select(" select sum(stock_in_row_wise_purchase_amount)stock_in_total_purchase_amount
        from(
        select i.medicine_name, i.product_id, i.quantity as stock_in_quantity,
        (select p.purchase_price from prices p where p.status ='Active' and p.end_date is null and p.product_id = i.product_id)purchase_price_per_unit,
        (select sum(p.purchase_price * i.quantity) from prices p where p.status ='Active' and p.end_date is null and p.product_id = i.product_id)stock_in_row_wise_purchase_amount
        from inventories i
        )sub_tbl ");

        $stock_available_prod = DB::select(" select sum(cnt_product_id)cnt_product_id from( select count(product_id)cnt_product_id FROM inventories i  where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) group by product_id, base_name )ttt ");
        $stock_unavailable_prod = DB::select(" select sum(cnt_product_id)cnt_product_id from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) group by product_id, base_name )ttt ");

        //sales & purchase info //
        $airhq_total_sales_today = DB::select(" select sum(s.total_payable_amount)airhq_total_sales_today from sales s where base_name = 'Air HQ (U)' and DATE(created_at) = CURDATE() "); 
        $airhq_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))airhq_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='Air HQ (U)' and p.end_date is null and p.status = 'Active' ");    

        $bsr_total_sales_today = DB::select(" select sum(s.total_payable_amount)bsr_total_sales_today from sales s where base_name = 'BAF BSR' and DATE(created_at) = CURDATE() "); 
        $bsr_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))bsr_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='BAF BSR' and p.end_date is null and p.status = 'Active' "); 
        
        $bbd_total_sales_today = DB::select(" select sum(s.total_payable_amount)bbd_total_sales_today from sales s where base_name = 'BAF BBD' and DATE(created_at) = CURDATE() "); 
        $bbd_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))bbd_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='BAF BBD' and p.end_date is null and p.status = 'Active' ");

        $mtr_total_sales_today = DB::select(" select sum(s.total_payable_amount)mtr_total_sales_today from sales s where base_name = 'BAF MTR' and DATE(created_at) = CURDATE() "); 
        $mtr_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))mtr_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='BAF MTR' and p.end_date is null and p.status = 'Active' ");

        $zhr_total_sales_today = DB::select(" select sum(s.total_payable_amount)zhr_total_sales_today from sales s where base_name = 'BAF ZHR' and DATE(created_at) = CURDATE() "); 
        $zhr_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))zhr_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='BAF ZHR' and p.end_date is null and p.status = 'Active' ");

        $pkp_total_sales_today = DB::select(" select sum(s.total_payable_amount)pkp_total_sales_today from sales s where base_name = 'BAF PKP' and DATE(created_at) = CURDATE() "); 
        $pkp_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))pkp_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='BAF PKP' and p.end_date is null and p.status = 'Active' ");

        $cxb_total_sales_today = DB::select(" select sum(s.total_payable_amount)cxb_total_sales_today from sales s where base_name = 'BAF CXB' and DATE(created_at) = CURDATE() "); 
        $cxb_total_purchase_today = DB::select(" select sum((d.total_qty * p.purchase_price))cxb_total_purchase_today
        from invent_details d, prices p where d.product_id = p.product_id and DATE(d.trnsc_time) = CURDATE() and d.base_name ='BAF CXB' and p.end_date is null and p.status = 'Active' ");


        //jan-jun //
        $airhq_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)airhq_total_sales_jan_to_jun from sales s where base_name = 'Air HQ (U)' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $airhq_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))airhq_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='Air HQ (U)' and p.end_date is null and p.status = 'Active' ");

        $bsr_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)bsr_total_sales_jan_to_jun from sales s where base_name = 'BAF BSR' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $bsr_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))bsr_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='BAF BSR' and p.end_date is null and p.status = 'Active' ");

        $bbd_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)bbd_total_sales_jan_to_jun from sales s where base_name = 'BAF BBD' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $bbd_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))bbd_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='BAF BBD' and p.end_date is null and p.status = 'Active' ");

        $mtr_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)mtr_total_sales_jan_to_jun from sales s where base_name = 'BAF MTR' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $mtr_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))mtr_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='BAF MTR' and p.end_date is null and p.status = 'Active' ");

        $zhr_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)zhr_total_sales_jan_to_jun from sales s where base_name = 'BAF ZHR' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $zhr_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))zhr_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='BAF ZHR' and p.end_date is null and p.status = 'Active' ");

        $pkp_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)pkp_total_sales_jan_to_jun from sales s where base_name = 'BAF PKP' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $pkp_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))pkp_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='BAF PKP' and p.end_date is null and p.status = 'Active' ");

        $cxb_total_sales_jan_to_jun = DB::select(" select sum(s.total_payable_amount)cxb_total_sales_jan_to_jun from sales s where base_name = 'BAF CXB' and DATE(created_at) between '2023-01-01' and '2023-06-30' "); 
        $cxb_total_purchase_jan_to_jun = DB::select(" select sum((d.total_qty * p.purchase_price))cxb_total_purchase_jan_to_jun from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-06-30' and d.base_name ='BAF CXB' and p.end_date is null and p.status = 'Active' ");


        //jul-dec //
        $airhq_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)airhq_total_sales_jul_to_dec from sales s where base_name = 'Air HQ (U)' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $airhq_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))airhq_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='Air HQ (U)' and p.end_date is null and p.status = 'Active' ");

        $bsr_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)bsr_total_sales_jul_to_dec from sales s where base_name = 'BAF BSR' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $bsr_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))bsr_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='BAF BSR' and p.end_date is null and p.status = 'Active' ");

        $bbd_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)bbd_total_sales_jul_to_dec from sales s where base_name = 'BAF BBD' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $bbd_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))bbd_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='BAF BBD' and p.end_date is null and p.status = 'Active' ");

        $mtr_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)mtr_total_sales_jul_to_dec from sales s where base_name = 'BAF MTR' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $mtr_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))mtr_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='BAF MTR' and p.end_date is null and p.status = 'Active' ");

        $zhr_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)zhr_total_sales_jul_to_dec from sales s where base_name = 'BAF ZHR' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $zhr_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))zhr_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='BAF ZHR' and p.end_date is null and p.status = 'Active' ");

        $pkp_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)pkp_total_sales_jul_to_dec from sales s where base_name = 'BAF PKP' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $pkp_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))pkp_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='BAF PKP' and p.end_date is null and p.status = 'Active' ");

        $cxb_total_sales_jul_to_dec = DB::select(" select sum(s.total_payable_amount)cxb_total_sales_jul_to_dec from sales s where base_name = 'BAF CXB' and DATE(created_at) between '2023-07-01' and '2023-12-30' "); 
        $cxb_total_purchase_jul_to_dec = DB::select(" select sum((d.total_qty * p.purchase_price))cxb_total_purchase_jul_to_dec from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-07-01' and '2023-12-30' and d.base_name ='BAF CXB' and p.end_date is null and p.status = 'Active' ");

        //Lifetime-total //
        $airhq_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)airhq_total_sales_lifetime from sales s where base_name = 'Air HQ (U)' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $airhq_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))airhq_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2027-12-30' and d.base_name ='Air HQ (U)' and p.end_date is null and p.status = 'Active' ");

        $bsr_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)bsr_total_sales_lifetime from sales s where base_name = 'BAF BSR' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $bsr_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))bsr_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2027-12-30' and d.base_name ='BAF BSR' and p.end_date is null and p.status = 'Active' ");

        $bbd_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)bbd_total_sales_lifetime from sales s where base_name = 'BAF BBD' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $bbd_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))bbd_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2027-12-30' and d.base_name ='BAF BBD' and p.end_date is null and p.status = 'Active' ");

        $mtr_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)mtr_total_sales_lifetime from sales s where base_name = 'BAF MTR' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $mtr_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))mtr_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2027-12-30' and d.base_name ='BAF MTR' and p.end_date is null and p.status = 'Active' ");

        $zhr_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)zhr_total_sales_lifetime from sales s where base_name = 'BAF ZHR' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $zhr_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))zhr_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2023-12-30' and d.base_name ='BAF ZHR' and p.end_date is null and p.status = 'Active' ");

        $pkp_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)pkp_total_sales_lifetime from sales s where base_name = 'BAF PKP' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $pkp_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))pkp_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2027-12-30' and d.base_name ='BAF PKP' and p.end_date is null and p.status = 'Active' ");

        $cxb_total_sales_lifetime = DB::select(" select sum(s.total_payable_amount)cxb_total_sales_lifetime from sales s where base_name = 'BAF CXB' and DATE(created_at) between '2023-01-01' and '2027-12-30' "); 
        $cxb_total_purchase_lifetime = DB::select(" select sum((d.total_qty * p.purchase_price))cxb_total_purchase_lifetime from invent_details d, prices p
        where d.product_id = p.product_id and DATE(d.trnsc_time) between '2023-01-01' and '2027-12-30' and d.base_name ='BAF CXB' and p.end_date is null and p.status = 'Active' ");


        // stock info //
        $airhq_stock_available_product = DB::select(" select sum(cnt_product_id)airhq_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='Air HQ (U)' group by product_id, base_name )ttt ");
        $airhq_stock_unavailable_product = DB::select(" select sum(cnt_product_id)airhq_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='Air HQ (U)' group by product_id, base_name )ttt ");
        $airhq_date_expired_product = DB::select(" select sum(cnt_product_id)airhq_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='Air HQ (U)' group by product_id, base_name )ttt ");

        $bsr_stock_available_product = DB::select(" select sum(cnt_product_id)bsr_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='BAF BSR' group by product_id, base_name )ttt ");
        $bsr_stock_unavailable_product = DB::select(" select sum(cnt_product_id)bsr_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='BAF BSR' group by product_id, base_name )ttt ");
        $bsr_date_expired_product = DB::select(" select sum(cnt_product_id)bsr_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='BAF BSR' group by product_id, base_name )ttt ");

        $bbd_stock_available_product = DB::select(" select sum(cnt_product_id)bbd_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='BAF BBD' group by product_id, base_name )ttt ");
        $bbd_stock_unavailable_product = DB::select(" select sum(cnt_product_id)bbd_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='BAF BBD' group by product_id, base_name )ttt ");
        $bbd_date_expired_product = DB::select(" select sum(cnt_product_id)bbd_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='BAF BBD' group by product_id, base_name )ttt ");

        $mtr_stock_available_product = DB::select(" select sum(cnt_product_id)mtr_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='BAF MTR' group by product_id, base_name )ttt ");
        $mtr_stock_unavailable_product = DB::select(" select sum(cnt_product_id)mtr_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='BAF MTR' group by product_id, base_name )ttt ");
        $mtr_date_expired_product = DB::select(" select sum(cnt_product_id)mtr_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='BAF MTR' group by product_id, base_name )ttt ");

        $zhr_stock_available_product = DB::select(" select sum(cnt_product_id)zhr_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='BAF ZHR' group by product_id, base_name )ttt ");
        $zhr_stock_unavailable_product = DB::select(" select sum(cnt_product_id)zhr_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='BAF ZHR' group by product_id, base_name )ttt ");
        $zhr_date_expired_product = DB::select(" select sum(cnt_product_id)zhr_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='BAF ZHR' group by product_id, base_name )ttt ");

        $pkp_stock_available_product = DB::select(" select sum(cnt_product_id)pkp_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='BAF PKP' group by product_id, base_name )ttt ");
        $pkp_stock_unavailable_product = DB::select(" select sum(cnt_product_id)pkp_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='BAF PKP' group by product_id, base_name )ttt ");
        $pkp_date_expired_product = DB::select(" select sum(cnt_product_id)pkp_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='BAF PKP' group by product_id, base_name )ttt ");

        $cxb_stock_available_product = DB::select(" select sum(cnt_product_id)cxb_stock_available_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) > coalesce(i.stock_out_quantity,0) and i.base_name ='BAF CXB' group by product_id, base_name )ttt ");
        $cxb_stock_unavailable_product = DB::select(" select sum(cnt_product_id)cxb_stock_unavailable_product from( select count(product_id)cnt_product_id FROM inventories i where coalesce(i.quantity,0) <= coalesce(i.stock_out_quantity,0) and i.base_name ='BAF CXB' group by product_id, base_name )ttt ");
        $cxb_date_expired_product = DB::select(" select sum(cnt_product_id)cxb_date_expired_product from( select count(product_id)cnt_product_id FROM inventories i where date(i.expiry_date) <= curdate() and i.base_name ='BAF CXB' group by product_id, base_name )ttt ");


        //top selling product//
        $airhq_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='AIR HQ (U)' group by medicine_name order by count(product_id) desc limit 3 ");
        $bsr_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='BAF BSR' group by medicine_name order by count(product_id) desc limit 3 ");
        $bbd_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='BAF BBD' group by medicine_name order by count(product_id) desc limit 3 ");
        $mtr_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='BAF MTR' group by medicine_name order by count(product_id) desc limit 3 ");
        $zhr_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='BAF ZHR' group by medicine_name order by count(product_id) desc limit 3 ");
        $pkp_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='BAF PKP' group by medicine_name order by count(product_id) desc limit 3 ");
        $cxb_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details where base_name ='BAF CXB' group by medicine_name order by count(product_id) desc limit 3 ");  
        $overall_top_selling_product = DB::select(" select medicine_name, count(product_id)cnt_product_id from sale_details group by medicine_name order by count(product_id) desc limit 7 ");


        
        return view('dashboard',compact('net_sales','net_purchase','stock_available_prod','stock_unavailable_prod','airhq_total_sales_today','airhq_total_purchase_today',
                                        'bsr_total_sales_today','bsr_total_purchase_today','bbd_total_sales_today','bbd_total_purchase_today','mtr_total_sales_today',
                                        'mtr_total_purchase_today','zhr_total_sales_today','zhr_total_purchase_today','pkp_total_sales_today','pkp_total_purchase_today',
                                        'cxb_total_sales_today','cxb_total_purchase_today',
                                        'airhq_total_sales_jan_to_jun','airhq_total_purchase_jan_to_jun','bsr_total_sales_jan_to_jun','bsr_total_purchase_jan_to_jun','bbd_total_sales_jan_to_jun','bbd_total_purchase_jan_to_jun',
                                        'mtr_total_sales_jan_to_jun','mtr_total_purchase_jan_to_jun','zhr_total_sales_jan_to_jun','zhr_total_purchase_jan_to_jun',
                                        'pkp_total_sales_jan_to_jun','pkp_total_purchase_jan_to_jun','cxb_total_sales_jan_to_jun','cxb_total_purchase_jan_to_jun',
                                        'airhq_total_sales_jul_to_dec','airhq_total_purchase_jul_to_dec','bsr_total_sales_jul_to_dec','bsr_total_purchase_jul_to_dec','bbd_total_sales_jul_to_dec','bbd_total_purchase_jul_to_dec',
                                        'mtr_total_sales_jul_to_dec','mtr_total_purchase_jul_to_dec','zhr_total_sales_jul_to_dec','zhr_total_purchase_jul_to_dec',
                                        'pkp_total_sales_jul_to_dec','pkp_total_purchase_jul_to_dec','cxb_total_sales_jul_to_dec','cxb_total_purchase_jul_to_dec',
                                        'airhq_total_sales_lifetime','airhq_total_purchase_lifetime','bsr_total_sales_lifetime','bsr_total_purchase_lifetime',
                                        'bbd_total_sales_lifetime','bbd_total_purchase_lifetime','mtr_total_sales_lifetime','mtr_total_purchase_lifetime',
                                        'zhr_total_sales_lifetime','zhr_total_purchase_lifetime','pkp_total_sales_lifetime','pkp_total_purchase_lifetime',
                                        'cxb_total_sales_lifetime','cxb_total_purchase_lifetime',
                                        'airhq_stock_available_product','airhq_stock_unavailable_product','airhq_date_expired_product','bsr_stock_available_product','bsr_stock_unavailable_product','bsr_date_expired_product',
                                        'bbd_stock_available_product','bbd_stock_unavailable_product','bbd_date_expired_product','mtr_stock_available_product','mtr_stock_unavailable_product','mtr_date_expired_product',
                                        'zhr_stock_available_product','zhr_stock_unavailable_product','zhr_date_expired_product','pkp_stock_available_product','pkp_stock_unavailable_product','pkp_date_expired_product',
                                        'cxb_stock_available_product','cxb_stock_unavailable_product','cxb_date_expired_product',
                                        'airhq_top_selling_product','bsr_top_selling_product','bbd_top_selling_product','mtr_top_selling_product','zhr_top_selling_product','pkp_top_selling_product','cxb_top_selling_product','overall_top_selling_product'));

    }
}
