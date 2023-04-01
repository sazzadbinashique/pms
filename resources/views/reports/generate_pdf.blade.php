<!DOCTYPE html>
<html>
<head>
    <title>Sales Invoice</title>
    <style>
    table, th, td {
    border:1px solid black;
    border-collapse: collapse;
    }
    </style>
</head>

<body>

  <div style="margin-top:-30px;">
     <p style="text-align:center;"><b>BAFWWA Pharmacy<b></p>
     <p style="text-align:center;"><b>Headquarters<b></p>
     <p style="text-align:center;"><b>Dhaka Cantonment, Dhaka-1206</b></p>
     <p style="text-align:center;"><b>Phone : 01xxxxxxxx...</p></b></br>
     <b style="text-align:center;"><b>Retail Sales Invoice</b>
  </div>

  <div>
    @foreach($sales_info as $sales_info)
     <p>Date : {{ date('d M Y H:i:s', strtotime($sales_info->created_at)) }}</p>
     <p>Sales Invoice No : {{ $sales_info->id }}</p>
     <p>Customer Name : {{ $sales_info->customer_name }}</p>
     <p>Customer Mobile : {{ $sales_info->customer_mobile }}</p>
     <p>Doctor / Specialist : {{ $sales_info->doctor_name }}</p></br>
     <p><b>Details : </b></p>
     @endforeach
  </div>

  <div>
      <table style="width:100%">
      <tr>
        <th>Ser No</th>
        <th>Item</th>
        <th>Qty</th> 
        <th>Price</th>
      </tr>
      
      <?php $total_qty = 0; $total_sales_amnttt = 0; ?>
      @foreach($sales_details as $key=>$sales_details)
      <tr>
        <td style="text-align:center;">{{ ++$key }}</td>          
        <td style="text-align:center;">{{ $sales_details->medicine_name }}</td>
        <td style="text-align:center;">{{ $sales_details->quantity }}</td>
        <td style="text-align:center;">{{ number_format($sales_details->sales_amount, 2) }}</td>
      </tr>
      <?php $total_qty = $total_qty + $sales_details->quantity;  ?>
      <?php $total_sales_amnttt = $total_sales_amnttt + number_format($sales_details->sales_amount, 2, '.', ',');  ?>
      @endforeach
     </table>
 </div>

  <div>
    <div style="float:left; margin-left:44%;"><b>Total : </b></div>
    <div style="float:left; margin-left:29%;"><b>{{ $total_qty }}</b></div>
    <div style="float:left; margin-left:7%;"><b>{{ $total_sales_amnttt }} Tk</b></div>
  </div>

  </br>
 
  <p style="margin-left:44%; margin-top:-8px;"><b>Vat</b></p>
  <p style="margin-left:90%; margin-top:-38px;"><b>0.00 Tk</b></p>

  <p style="margin-left:44%; margin-top:-8px;"><b>Discount</b></p>
  <p style="margin-left:90%; margin-top:-38px;"><b>{{ number_format($sales_info->total_discount_amnt, 2) }} Tk</b></p>
 


</br>
 <div>
      <table style="width:100%">
       <tr>
        <th style="text-align:right;">Total Payable</th>
        <th style="text-align:right;">{{ $sales_info->total_payable_amount }} Tk</th>
       </tr>
     </table>
 </div>



 </br></br></br></br></br></br>
 <div>
 <p style="margin-left:45%;">Thank You</p>
 </div>

</body>
</html>
