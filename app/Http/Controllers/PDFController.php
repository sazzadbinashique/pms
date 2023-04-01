<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use \PDF;

use App\Product;
use App\Price;
use App\Sale;
use App\SaleDetail;
use App\Inventory;
use DB;
use Auth;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($sales_id)
    {

        $sales_info = DB::select(" select s.id, s.customer_name, s.customer_mobile, s.doctor_name, s.total_sales_amount, s.total_discount_amnt, s.total_payable_amount, s.created_at from sales s where id = $sales_id ");
        
        $sales_details = DB::select(" select d.medicine_name, d.product_id, d.sales_id, d.price_id, d.quantity, d.purchase_price, d.sales_price, d.discount_rate, d.sales_amount, d.discount, d.base_name from sale_details d where d.sales_id = $sales_id ");

        $pdf = PDF::loadView('reports/generate_pdf', compact('sales_info','sales_details'));
  
        return $pdf->download('sales_invoice.pdf');
    }
}
