@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')


<div class="container-fluid" style="margin-top:-20px;">
  <span style="font-size:20px; font-weight:bold; font-family:arial; margin-left:0%;"><i class="fa fa-dashboard" style="font-size:20px;color:red"></i> Dashboard</span>

  @can('display-dashboard')
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12" style="border:4px solid gray; margin-left:12px; width:98%;">

         <div class="row" style="margin-top:7px; margin-bottom:7px;">
            &nbsp;&nbsp;
            <div class="col-xs-3 col-sm-3 col-md-3 " style="background-color:#007bff;">
              <h5 style="color:#fff; text-align:center;">Total Sales</h5>
              <h5 style="color:#fff; text-align:center; font-size:16px;">@foreach($net_sales as $net_sales){{$net_sales->total_payable_amount}}@endforeach Tk</h5>
            </div>
            &nbsp;&nbsp;
            <div class="col-xs-3 col-sm-3 col-md-3" style="background-color:#17a2b8;">
              <h5 style="color:#fff; text-align:center;">Total Purchase</h5>
              <h5 style="color:#fff; text-align:center; font-size:16px;">@foreach($net_purchase as $net_purchase){{$net_purchase->stock_in_total_purchase_amount}}@endforeach Tk</h5>
            </div>
            &nbsp;&nbsp;
            <div class="col-xs-3 col-sm-3 col-md-3" style="background-color:#28a745;">
              <a class="nav-link" href="{{ url('/stock_available_report') }}" style="color:white;">
              <h5 style="color:#fff; text-align:center;">Stock Available</h5>
              <h5 style="color:#fff; text-align:center; font-size:16px;">Product : @foreach($stock_available_prod as $stock_available_prod){{$stock_available_prod->cnt_product_id}}@endforeach</h5>
              </a>
            </div>
            &nbsp;&nbsp;
            <div class="col-xs-3 col-sm-3 col-md-3 blink_me" style="background-color:red; width:225px;">
              <a class="nav-link" href="{{ url('/stock_unavailable_report') }}" style="color:white;">
              <h5 style="color:#fff; text-align:center;">Stock Unavailable</h5>
              <h5 style="color:#fff; text-align:center; font-size:16px;">Product : @foreach($stock_unavailable_prod as $stock_unavailable_prod){{$stock_unavailable_prod->cnt_product_id}}@endforeach</h5>
              </a>
            </div>

         </div>

     </div>
  </div>

  </br>

   <div class="row">
      <div class="col-xs-10 col-sm-10 col-md-10" style="border:4px solid gray; margin-left:12px; width:98%;">
         <div class="row" style="margin-top:7px; margin-bottom:7px;">
                 <div class="col-xs-12 col-sm-12 col-md-12">
                     <table class="table table-hover table-striped" style="line-height: 13px;">
                        <thead  style="background-color:#0000FF; color:white;">
                           <tr>
                           <th>Base</th>                        
                           <th></th>
                           <th></th>
                           <th style="text-align:right;">Sales & Purchase</th>
                           <th>Info</th>
                           <th></th>
                           <th></th>
                           </tr>

                           <tr>
                             <th></th>
                             <th>Today's</th>
                             <th>Daily Profit</th>
                             <th>Jan - Jun</th>
                             <th>Jul - Dec</th>
                             <th>Yearly Total</th>
                             <th>Total (Lifetime)</th>
                           </tr>
                        </thead>

                        <!-- today !-->
                        @foreach($airhq_total_sales_today as $airhq_total_sales_today) <?php $airhq_total_sales_today = $airhq_total_sales_today->airhq_total_sales_today; ?>@endforeach
                        @foreach($airhq_total_purchase_today as $airhq_total_purchase_today) <?php $airhq_total_purchase_today = $airhq_total_purchase_today->airhq_total_purchase_today; ?>@endforeach

                        @foreach($bsr_total_sales_today as $bsr_total_sales_today) <?php $bsr_total_sales_today = $bsr_total_sales_today->bsr_total_sales_today; ?>@endforeach
                        @foreach($bsr_total_purchase_today as $bsr_total_purchase_today) <?php $bsr_total_purchase_today = $bsr_total_purchase_today->bsr_total_purchase_today; ?>@endforeach

                        @foreach($bbd_total_sales_today as $bbd_total_sales_today) <?php $bbd_total_sales_today = $bbd_total_sales_today->bbd_total_sales_today; ?>@endforeach
                        @foreach($bbd_total_purchase_today as $bbd_total_purchase_today) <?php $bbd_total_purchase_today = $bbd_total_purchase_today->bbd_total_purchase_today; ?>@endforeach

                        @foreach($mtr_total_sales_today as $mtr_total_sales_today) <?php $mtr_total_sales_today = $mtr_total_sales_today->mtr_total_sales_today; ?>@endforeach
                        @foreach($mtr_total_purchase_today as $mtr_total_purchase_today) <?php $mtr_total_purchase_today = $mtr_total_purchase_today->mtr_total_purchase_today; ?>@endforeach

                        @foreach($zhr_total_sales_today as $zhr_total_sales_today) <?php $zhr_total_sales_today = $zhr_total_sales_today->zhr_total_sales_today; ?>@endforeach
                        @foreach($zhr_total_purchase_today as $zhr_total_purchase_today) <?php $zhr_total_purchase_today = $zhr_total_purchase_today->zhr_total_purchase_today; ?>@endforeach

                        @foreach($pkp_total_sales_today as $pkp_total_sales_today) <?php $pkp_total_sales_today = $pkp_total_sales_today->pkp_total_sales_today; ?>@endforeach
                        @foreach($pkp_total_purchase_today as $pkp_total_purchase_today) <?php $pkp_total_purchase_today = $pkp_total_purchase_today->pkp_total_purchase_today; ?>@endforeach

                        @foreach($cxb_total_sales_today as $cxb_total_sales_today) <?php $cxb_total_sales_today = $cxb_total_sales_today->cxb_total_sales_today; ?>@endforeach
                        @foreach($cxb_total_purchase_today as $cxb_total_purchase_today) <?php $cxb_total_purchase_today = $cxb_total_purchase_today->cxb_total_purchase_today; ?>@endforeach


                        <!-- jan-jun !-->
                        @foreach($airhq_total_sales_jan_to_jun as $airhq_total_sales_jan_to_jun) <?php $airhq_total_sales_jan_to_jun = $airhq_total_sales_jan_to_jun->airhq_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($airhq_total_purchase_jan_to_jun as $airhq_total_purchase_jan_to_jun) <?php $airhq_total_purchase_jan_to_jun = $airhq_total_purchase_jan_to_jun->airhq_total_purchase_jan_to_jun; ?>@endforeach

                        @foreach($bsr_total_sales_jan_to_jun as $bsr_total_sales_jan_to_jun) <?php $bsr_total_sales_jan_to_jun = $bsr_total_sales_jan_to_jun->bsr_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($bsr_total_purchase_jan_to_jun as $bsr_total_purchase_jan_to_jun) <?php $bsr_total_purchase_jan_to_jun = $bsr_total_purchase_jan_to_jun->bsr_total_purchase_jan_to_jun; ?>@endforeach

                        @foreach($bbd_total_sales_jan_to_jun as $bbd_total_sales_jan_to_jun) <?php $bbd_total_sales_jan_to_jun = $bbd_total_sales_jan_to_jun->bbd_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($bbd_total_purchase_jan_to_jun as $bbd_total_purchase_jan_to_jun) <?php $bbd_total_purchase_jan_to_jun = $bbd_total_purchase_jan_to_jun->bbd_total_purchase_jan_to_jun; ?>@endforeach

                        @foreach($mtr_total_sales_jan_to_jun as $mtr_total_sales_jan_to_jun) <?php $mtr_total_sales_jan_to_jun = $mtr_total_sales_jan_to_jun->mtr_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($mtr_total_purchase_jan_to_jun as $mtr_total_purchase_jan_to_jun) <?php $mtr_total_purchase_jan_to_jun = $mtr_total_purchase_jan_to_jun->mtr_total_purchase_jan_to_jun; ?>@endforeach

                        @foreach($zhr_total_sales_jan_to_jun as $zhr_total_sales_jan_to_jun) <?php $zhr_total_sales_jan_to_jun = $zhr_total_sales_jan_to_jun->zhr_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($zhr_total_purchase_jan_to_jun as $zhr_total_purchase_jan_to_jun) <?php $zhr_total_purchase_jan_to_jun = $zhr_total_purchase_jan_to_jun->zhr_total_purchase_jan_to_jun; ?>@endforeach

                        @foreach($pkp_total_sales_jan_to_jun as $pkp_total_sales_jan_to_jun) <?php $pkp_total_sales_jan_to_jun = $pkp_total_sales_jan_to_jun->pkp_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($pkp_total_purchase_jan_to_jun as $pkp_total_purchase_jan_to_jun) <?php $pkp_total_purchase_jan_to_jun = $pkp_total_purchase_jan_to_jun->pkp_total_purchase_jan_to_jun; ?>@endforeach

                        @foreach($cxb_total_sales_jan_to_jun as $cxb_total_sales_jan_to_jun) <?php $cxb_total_sales_jan_to_jun = $cxb_total_sales_jan_to_jun->cxb_total_sales_jan_to_jun; ?>@endforeach
                        @foreach($cxb_total_purchase_jan_to_jun as $cxb_total_purchase_jan_to_jun) <?php $cxb_total_purchase_jan_to_jun = $cxb_total_purchase_jan_to_jun->cxb_total_purchase_jan_to_jun; ?>@endforeach


                        <!-- jul-dec !-->
                        @foreach($airhq_total_sales_jul_to_dec as $airhq_total_sales_jul_to_dec) <?php $airhq_total_sales_jul_to_dec = $airhq_total_sales_jul_to_dec->airhq_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($airhq_total_purchase_jul_to_dec as $airhq_total_purchase_jul_to_dec) <?php $airhq_total_purchase_jul_to_dec = $airhq_total_purchase_jul_to_dec->airhq_total_purchase_jul_to_dec; ?>@endforeach

                        @foreach($bsr_total_sales_jul_to_dec as $bsr_total_sales_jul_to_dec) <?php $bsr_total_sales_jul_to_dec = $bsr_total_sales_jul_to_dec->bsr_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($bsr_total_purchase_jul_to_dec as $bsr_total_purchase_jul_to_dec) <?php $bsr_total_purchase_jul_to_dec = $bsr_total_purchase_jul_to_dec->bsr_total_purchase_jul_to_dec; ?>@endforeach

                        @foreach($bbd_total_sales_jul_to_dec as $bbd_total_sales_jul_to_dec) <?php $bbd_total_sales_jul_to_dec = $bbd_total_sales_jul_to_dec->bbd_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($bbd_total_purchase_jul_to_dec as $bbd_total_purchase_jul_to_dec) <?php $bbd_total_purchase_jul_to_dec = $bbd_total_purchase_jul_to_dec->bbd_total_purchase_jul_to_dec; ?>@endforeach

                        @foreach($mtr_total_sales_jul_to_dec as $mtr_total_sales_jul_to_dec) <?php $mtr_total_sales_jul_to_dec = $mtr_total_sales_jul_to_dec->mtr_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($mtr_total_purchase_jul_to_dec as $mtr_total_purchase_jul_to_dec) <?php $mtr_total_purchase_jul_to_dec = $mtr_total_purchase_jul_to_dec->mtr_total_purchase_jul_to_dec; ?>@endforeach

                        @foreach($zhr_total_sales_jul_to_dec as $zhr_total_sales_jul_to_dec) <?php $zhr_total_sales_jul_to_dec = $zhr_total_sales_jul_to_dec->zhr_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($zhr_total_purchase_jul_to_dec as $zhr_total_purchase_jul_to_dec) <?php $zhr_total_purchase_jul_to_dec = $zhr_total_purchase_jul_to_dec->zhr_total_purchase_jul_to_dec; ?>@endforeach

                        @foreach($pkp_total_sales_jul_to_dec as $pkp_total_sales_jul_to_dec) <?php $pkp_total_sales_jul_to_dec = $pkp_total_sales_jul_to_dec->pkp_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($pkp_total_purchase_jul_to_dec as $pkp_total_purchase_jul_to_dec) <?php $pkp_total_purchase_jul_to_dec = $pkp_total_purchase_jul_to_dec->pkp_total_purchase_jul_to_dec; ?>@endforeach

                        @foreach($cxb_total_sales_jul_to_dec as $cxb_total_sales_jul_to_dec) <?php $cxb_total_sales_jul_to_dec = $cxb_total_sales_jul_to_dec->cxb_total_sales_jul_to_dec; ?>@endforeach
                        @foreach($cxb_total_purchase_jul_to_dec as $cxb_total_purchase_jul_to_dec) <?php $cxb_total_purchase_jul_to_dec = $cxb_total_purchase_jul_to_dec->cxb_total_purchase_jul_to_dec; ?>@endforeach


                        <!-- lifetime total!-->
                        @foreach($airhq_total_sales_lifetime as $airhq_total_sales_lifetime) <?php $airhq_total_sales_lifetime = $airhq_total_sales_lifetime->airhq_total_sales_lifetime; ?>@endforeach
                        @foreach($airhq_total_purchase_lifetime as $airhq_total_purchase_lifetime) <?php $airhq_total_purchase_lifetime = $airhq_total_purchase_lifetime->airhq_total_purchase_lifetime; ?>@endforeach

                        @foreach($bsr_total_sales_lifetime as $bsr_total_sales_lifetime) <?php $bsr_total_sales_lifetime = $bsr_total_sales_lifetime->bsr_total_sales_lifetime; ?>@endforeach
                        @foreach($bsr_total_purchase_lifetime as $bsr_total_purchase_lifetime) <?php $bsr_total_purchase_lifetime = $bsr_total_purchase_lifetime->bsr_total_purchase_lifetime; ?>@endforeach

                        @foreach($bbd_total_sales_lifetime as $bbd_total_sales_lifetime) <?php $bbd_total_sales_lifetime = $bbd_total_sales_lifetime->bbd_total_sales_lifetime; ?>@endforeach
                        @foreach($bbd_total_purchase_lifetime as $bbd_total_purchase_lifetime) <?php $bbd_total_purchase_lifetime = $bbd_total_purchase_lifetime->bbd_total_purchase_lifetime; ?>@endforeach

                        @foreach($mtr_total_sales_lifetime as $mtr_total_sales_lifetime) <?php $mtr_total_sales_lifetime = $mtr_total_sales_lifetime->mtr_total_sales_lifetime; ?>@endforeach
                        @foreach($mtr_total_purchase_lifetime as $mtr_total_purchase_lifetime) <?php $mtr_total_purchase_lifetime = $mtr_total_purchase_lifetime->mtr_total_purchase_lifetime; ?>@endforeach

                        @foreach($zhr_total_sales_lifetime as $zhr_total_sales_lifetime) <?php $zhr_total_sales_lifetime = $zhr_total_sales_lifetime->zhr_total_sales_lifetime; ?>@endforeach
                        @foreach($zhr_total_purchase_lifetime as $zhr_total_purchase_lifetime) <?php $zhr_total_purchase_lifetime = $zhr_total_purchase_lifetime->zhr_total_purchase_lifetime; ?>@endforeach

                        @foreach($pkp_total_sales_lifetime as $pkp_total_sales_lifetime) <?php $pkp_total_sales_lifetime = $pkp_total_sales_lifetime->pkp_total_sales_lifetime; ?>@endforeach
                        @foreach($pkp_total_purchase_lifetime as $pkp_total_purchase_lifetime) <?php $pkp_total_purchase_lifetime = $pkp_total_purchase_lifetime->pkp_total_purchase_lifetime; ?>@endforeach

                        @foreach($cxb_total_sales_lifetime as $cxb_total_sales_lifetime) <?php $cxb_total_sales_lifetime = $cxb_total_sales_lifetime->cxb_total_sales_lifetime; ?>@endforeach
                        @foreach($cxb_total_purchase_lifetime as $cxb_total_purchase_lifetime) <?php $cxb_total_purchase_lifetime = $cxb_total_purchase_lifetime->cxb_total_purchase_lifetime; ?>@endforeach

                        <tbody style="font-weight:bold; font-family:sans-serif; font-size:13px;">
                        <tr>
                           <td>AIR HQ (U)</td>
                           <td>{{$airhq_total_sales_today +0}} / {{$airhq_total_purchase_today +0}}</td>
                           <td>@if($airhq_total_sales_today >= $airhq_total_purchase_today) {{$airhq_total_sales_today - $airhq_total_purchase_today}} @else - {{$airhq_total_purchase_today - $airhq_total_sales_today}}@endif</td>
                           <td>{{$airhq_total_sales_jan_to_jun +0}} / {{$airhq_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$airhq_total_sales_jul_to_dec +0}} / {{$airhq_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$airhq_total_sales_jan_to_jun + $airhq_total_sales_jul_to_dec +0}} / {{$airhq_total_purchase_jan_to_jun + $airhq_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$airhq_total_sales_lifetime +0}} / {{$airhq_total_purchase_lifetime +0}}</td>
                        </tr>
                        <tr>
                           <td>BAF BSR</td>
                           <td>{{$bsr_total_sales_today +0}} / {{$bsr_total_purchase_today +0}}</td>
                           <td>@if($bsr_total_sales_today >= $bsr_total_purchase_today) {{$bsr_total_sales_today - $bsr_total_purchase_today}} @else - {{$bsr_total_purchase_today - $bsr_total_sales_today}}@endif</td>
                           <td>{{$bsr_total_sales_jan_to_jun +0}} / {{$bsr_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$bsr_total_sales_jul_to_dec +0}} / {{$bsr_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$bsr_total_sales_jan_to_jun + $bsr_total_sales_jul_to_dec +0}} / {{$bsr_total_purchase_jan_to_jun + $bsr_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$bsr_total_sales_lifetime +0}} / {{$bsr_total_purchase_lifetime +0}}</td>                  
                        </tr>
                        <tr>
                           <td>BAF BBD</td>
                           <td>{{$bbd_total_sales_today +0}} / {{$bbd_total_purchase_today +0}}</td>
                           <td>@if($bbd_total_sales_today >= $bbd_total_purchase_today) {{$bbd_total_sales_today - $bbd_total_purchase_today}} @else - {{$bbd_total_purchase_today - $bbd_total_sales_today}}@endif</td>
                           <td>{{$bbd_total_sales_jan_to_jun +0}} / {{$bbd_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$bbd_total_sales_jul_to_dec +0}} / {{$bbd_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$bbd_total_sales_jan_to_jun + $bbd_total_sales_jul_to_dec +0}} / {{$bbd_total_purchase_jan_to_jun + $bbd_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$bbd_total_sales_lifetime +0}} / {{$bbd_total_purchase_lifetime +0}}</td>                 
                        </tr>
                        <tr>
                           <td>BAF MTR</td>
                           <td>{{$mtr_total_sales_today +0}} / {{$mtr_total_purchase_today +0}}</td>
                           <td>@if($mtr_total_sales_today >= $mtr_total_purchase_today) {{$mtr_total_sales_today - $mtr_total_purchase_today}} @else - {{$mtr_total_purchase_today - $mtr_total_sales_today}}@endif</td>
                           <td>{{$mtr_total_sales_jan_to_jun +0}} / {{$mtr_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$mtr_total_sales_jul_to_dec +0}} / {{$mtr_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$mtr_total_sales_jan_to_jun + $mtr_total_sales_jul_to_dec +0}} / {{$mtr_total_purchase_jan_to_jun + $mtr_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$mtr_total_sales_lifetime +0}} / {{$mtr_total_purchase_lifetime +0}}</td>                    
                        </tr>
                        <tr>
                           <td>BAF ZHR</td>
                           <td>{{$zhr_total_sales_today +0}} / {{$zhr_total_purchase_today +0}}</td>
                           <td>@if($zhr_total_sales_today >= $zhr_total_purchase_today) {{$zhr_total_sales_today - $zhr_total_purchase_today}} @else - {{$zhr_total_purchase_today - $zhr_total_sales_today}}@endif</td>
                           <td>{{$zhr_total_sales_jan_to_jun +0}} / {{$zhr_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$zhr_total_sales_jul_to_dec +0}} / {{$zhr_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$zhr_total_sales_jan_to_jun + $zhr_total_sales_jul_to_dec +0}} / {{$zhr_total_purchase_jan_to_jun + $zhr_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$zhr_total_sales_lifetime +0}} / {{$zhr_total_purchase_lifetime +0}}</td>                       
                        </tr>
                        <tr>
                           <td>BAF PKP</td>
                           <td>{{$pkp_total_sales_today +0}} / {{$pkp_total_purchase_today +0}}</td>
                           <td>@if($pkp_total_sales_today >= $pkp_total_purchase_today) {{$pkp_total_sales_today - $pkp_total_purchase_today}} @else - {{$pkp_total_purchase_today - $pkp_total_sales_today}}@endif</td>
                           <td>{{$pkp_total_sales_jan_to_jun +0}} / {{$pkp_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$pkp_total_sales_jul_to_dec +0}} / {{$pkp_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$pkp_total_sales_jan_to_jun + $pkp_total_sales_jul_to_dec +0}} / {{$pkp_total_purchase_jan_to_jun + $pkp_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$pkp_total_sales_lifetime +0}} / {{$pkp_total_purchase_lifetime +0}}</td>                       
                        </tr>
                        <tr>
                           <td>BAF CXB</td>
                           <td>{{$cxb_total_sales_today +0}} / {{$cxb_total_purchase_today +0}}</td>
                           <td>@if($cxb_total_sales_today >= $cxb_total_purchase_today) {{$cxb_total_sales_today - $cxb_total_purchase_today}} @else - {{$cxb_total_purchase_today - $cxb_total_sales_today}}@endif</td>
                           <td>{{$cxb_total_sales_jan_to_jun +0}} / {{$cxb_total_purchase_jan_to_jun +0}}</td>
                           <td>{{$cxb_total_sales_jul_to_dec +0}} / {{$cxb_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$cxb_total_sales_jan_to_jun + $cxb_total_sales_jul_to_dec +0}} / {{$cxb_total_purchase_jan_to_jun + $cxb_total_purchase_jul_to_dec +0}}</td>
                           <td>{{$cxb_total_sales_lifetime +0}} / {{$cxb_total_purchase_lifetime +0}}</td>                      
                        </tr>
                        <tr>
                           <td><b>Grand Total : </b></td>
                           <td><b>{{$airhq_total_sales_today + $bsr_total_sales_today + $bbd_total_sales_today + $mtr_total_sales_today + $zhr_total_sales_today + $pkp_total_sales_today + $cxb_total_sales_today +0}} / {{$airhq_total_purchase_today + $bsr_total_purchase_today + $bbd_total_purchase_today + $mtr_total_purchase_today + $zhr_total_purchase_today + $pkp_total_purchase_today + $cxb_total_purchase_today +0}}</b></td>
                           <td><b>{{($airhq_total_sales_today + $bsr_total_sales_today + $bbd_total_sales_today + $mtr_total_sales_today + $zhr_total_sales_today + $pkp_total_sales_today + $cxb_total_sales_today +0) - ($airhq_total_purchase_today + $bsr_total_purchase_today + $bbd_total_purchase_today + $mtr_total_purchase_today + $zhr_total_purchase_today + $pkp_total_purchase_today + $cxb_total_purchase_today +0)}}</b></td>
                           <td><b>{{$airhq_total_sales_jan_to_jun + $bsr_total_sales_jan_to_jun + $bbd_total_sales_jan_to_jun + $mtr_total_sales_jan_to_jun + $zhr_total_sales_jan_to_jun + $pkp_total_sales_jan_to_jun +$cxb_total_sales_jan_to_jun +0}} / {{$airhq_total_purchase_jan_to_jun + $bsr_total_purchase_jan_to_jun + $bbd_total_purchase_jan_to_jun + $mtr_total_purchase_jan_to_jun + $zhr_total_purchase_jan_to_jun + $pkp_total_purchase_jan_to_jun + $cxb_total_purchase_jan_to_jun +0}}</b></td>
                           <td><b>{{$airhq_total_sales_jul_to_dec + $bsr_total_sales_jul_to_dec + $bbd_total_sales_jul_to_dec + $mtr_total_sales_jul_to_dec + $zhr_total_sales_jul_to_dec + $pkp_total_sales_jul_to_dec + $cxb_total_sales_jul_to_dec + 0}} / {{$airhq_total_purchase_jul_to_dec + $bsr_total_purchase_jul_to_dec + $bbd_total_purchase_jul_to_dec + $mtr_total_purchase_jul_to_dec + $zhr_total_purchase_jul_to_dec + $pkp_total_purchase_jul_to_dec + $cxb_total_purchase_jul_to_dec +0}}</b></td>
                           <td><b>{{$airhq_total_sales_jan_to_jun + $airhq_total_sales_jul_to_dec + $bsr_total_sales_jan_to_jun + $bsr_total_sales_jul_to_dec + $bbd_total_sales_jan_to_jun + $bbd_total_sales_jul_to_dec + $mtr_total_sales_jan_to_jun + $mtr_total_sales_jul_to_dec + $zhr_total_sales_jan_to_jun + $zhr_total_sales_jul_to_dec + $pkp_total_sales_jan_to_jun + $pkp_total_sales_jul_to_dec +$cxb_total_sales_jan_to_jun + $cxb_total_sales_jul_to_dec +0}} / {{$airhq_total_purchase_jan_to_jun + $airhq_total_purchase_jul_to_dec + $bsr_total_purchase_jan_to_jun + $bsr_total_purchase_jul_to_dec + $bbd_total_purchase_jan_to_jun + $bbd_total_purchase_jul_to_dec + $mtr_total_purchase_jan_to_jun + $mtr_total_purchase_jul_to_dec + $zhr_total_purchase_jan_to_jun + $zhr_total_purchase_jul_to_dec + $pkp_total_purchase_jan_to_jun + $pkp_total_purchase_jul_to_dec + $cxb_total_purchase_jan_to_jun + $cxb_total_purchase_jul_to_dec +0}}</b></td>
                           <td><b>{{$airhq_total_sales_lifetime + $bsr_total_sales_lifetime + $bbd_total_sales_lifetime + $mtr_total_sales_lifetime + $zhr_total_sales_lifetime + $pkp_total_sales_lifetime + $cxb_total_sales_lifetime +0}} / {{$airhq_total_purchase_lifetime + $bsr_total_purchase_lifetime + $bbd_total_purchase_lifetime + $mtr_total_purchase_lifetime + $zhr_total_purchase_lifetime + $pkp_total_purchase_lifetime + $cxb_total_purchase_lifetime +0}}</b></td>
                        </tr>
                       </tbody>
                   </table> 
                </div>   
               
            </div>
      </div>


   </div>


 </br>

 <div class="row">
      <div class="col-xs-10 col-sm-10 col-md-10" style="border:4px solid gray; margin-left:12px; width:80%;">
         <div class="row" style="margin-top:7px; margin-bottom:7px;">
                 <div class="col-xs-12 col-sm-12 col-md-12">
                     <table class="table table-hover table-striped" id="sales_tbl">
                        <thead  style="background-color:#800080; color:white;">
                           <tr>
                             <th>Status</th>
                             <th></th>
                             <th></th>
                             <th></th>
                             <th>Stock Info</th>
                             <th></th>
                             <th></th>
                             <th></th>
                             <th></th>
                           </tr>
                           <tr>
                             <th></th>
                             <th>AIR HQ (U)</th>
                             <th>BAF BSR</th>
                             <th>BAF BBD</th>
                             <th>BAF MTR</th>
                             <th>BAF ZHR</th>
                             <th>BAF PKP</th>
                             <th>BAF CXB</th>
                             <th>Total</th>
                           </tr>
                        </thead>

                        @foreach($airhq_stock_available_product as $airhq_stock_available_product) <?php $airhq_stock_available_product = $airhq_stock_available_product->airhq_stock_available_product; ?>@endforeach
                        @foreach($airhq_stock_unavailable_product as $airhq_stock_unavailable_product) <?php $airhq_stock_unavailable_product = $airhq_stock_unavailable_product->airhq_stock_unavailable_product; ?>@endforeach
                        @foreach($airhq_date_expired_product as $airhq_date_expired_product) <?php $airhq_date_expired_product = $airhq_date_expired_product->airhq_date_expired_product; ?>@endforeach

                        @foreach($bsr_stock_available_product as $bsr_stock_available_product) <?php $bsr_stock_available_product = $bsr_stock_available_product->bsr_stock_available_product; ?>@endforeach
                        @foreach($bsr_stock_unavailable_product as $bsr_stock_unavailable_product) <?php $bsr_stock_unavailable_product = $bsr_stock_unavailable_product->bsr_stock_unavailable_product; ?>@endforeach
                        @foreach($bsr_date_expired_product as $bsr_date_expired_product) <?php $bsr_date_expired_product = $bsr_date_expired_product->bsr_date_expired_product; ?>@endforeach

                        @foreach($bbd_stock_available_product as $bbd_stock_available_product) <?php $bbd_stock_available_product = $bbd_stock_available_product->bbd_stock_available_product; ?>@endforeach
                        @foreach($bbd_stock_unavailable_product as $bbd_stock_unavailable_product) <?php $bbd_stock_unavailable_product = $bbd_stock_unavailable_product->bbd_stock_unavailable_product; ?>@endforeach
                        @foreach($bbd_date_expired_product as $bbd_date_expired_product) <?php $bbd_date_expired_product = $bbd_date_expired_product->bbd_date_expired_product; ?>@endforeach

                        @foreach($mtr_stock_available_product as $mtr_stock_available_product) <?php $mtr_stock_available_product = $mtr_stock_available_product->mtr_stock_available_product; ?>@endforeach
                        @foreach($mtr_stock_unavailable_product as $mtr_stock_unavailable_product) <?php $mtr_stock_unavailable_product = $mtr_stock_unavailable_product->mtr_stock_unavailable_product; ?>@endforeach
                        @foreach($mtr_date_expired_product as $mtr_date_expired_product) <?php $mtr_date_expired_product = $mtr_date_expired_product->mtr_date_expired_product; ?>@endforeach

                        @foreach($zhr_stock_available_product as $zhr_stock_available_product) <?php $zhr_stock_available_product = $zhr_stock_available_product->zhr_stock_available_product; ?>@endforeach
                        @foreach($zhr_stock_unavailable_product as $zhr_stock_unavailable_product) <?php $zhr_stock_unavailable_product = $zhr_stock_unavailable_product->zhr_stock_unavailable_product; ?>@endforeach
                        @foreach($zhr_date_expired_product as $zhr_date_expired_product) <?php $zhr_date_expired_product = $zhr_date_expired_product->zhr_date_expired_product; ?>@endforeach

                        @foreach($pkp_stock_available_product as $pkp_stock_available_product) <?php $pkp_stock_available_product = $pkp_stock_available_product->pkp_stock_available_product; ?>@endforeach
                        @foreach($pkp_stock_unavailable_product as $pkp_stock_unavailable_product) <?php $pkp_stock_unavailable_product = $pkp_stock_unavailable_product->pkp_stock_unavailable_product; ?>@endforeach
                        @foreach($pkp_date_expired_product as $pkp_date_expired_product) <?php $pkp_date_expired_product = $pkp_date_expired_product->pkp_date_expired_product; ?>@endforeach

                        @foreach($cxb_stock_available_product as $cxb_stock_available_product) <?php $cxb_stock_available_product = $cxb_stock_available_product->cxb_stock_available_product; ?>@endforeach
                        @foreach($cxb_stock_unavailable_product as $cxb_stock_unavailable_product) <?php $cxb_stock_unavailable_product = $cxb_stock_unavailable_product->cxb_stock_unavailable_product; ?>@endforeach
                        @foreach($cxb_date_expired_product as $cxb_date_expired_product) <?php $cxb_date_expired_product = $cxb_date_expired_product->cxb_date_expired_product; ?>@endforeach
                        <tbody>
                        <tr style="font-weight:bold;">
                           <td>Available</td>
                           <td>{{$airhq_stock_available_product}}</td>
                           <td>{{$bsr_stock_available_product}}</td>
                           <td>{{$bbd_stock_available_product}}</td>
                           <td>{{$mtr_stock_available_product}}</td>
                           <td>{{$zhr_stock_available_product}}</td>
                           <td>{{$pkp_stock_available_product}}</td>
                           <td>{{$cxb_stock_available_product}}</td>
                           <td>{{$airhq_stock_available_product + $bsr_stock_available_product + $bbd_stock_available_product + $mtr_stock_available_product + $zhr_stock_available_product + $pkp_stock_available_product + $cxb_stock_available_product}}</td>
                        </tr>

                        <tr style="font-weight:bold;">
                           <td>Unavailable</td>
                           <td>{{$airhq_stock_unavailable_product}}</td>
                           <td>{{$bsr_stock_unavailable_product}}</td>
                           <td>{{$bbd_stock_unavailable_product}}</td>
                           <td>{{$mtr_stock_unavailable_product}}</td>
                           <td>{{$zhr_stock_unavailable_product}}</td>
                           <td>{{$pkp_stock_unavailable_product}}</td>
                           <td>{{$cxb_stock_unavailable_product}}</td>
                           <td>{{$airhq_stock_unavailable_product + $bsr_stock_unavailable_product + $bbd_stock_unavailable_product + $mtr_stock_unavailable_product + $zhr_stock_unavailable_product + $pkp_stock_unavailable_product + $cxb_stock_unavailable_product}}</td>
                        </tr>

                        
                        <tr style="font-weight:bold;">
                           <td>Date Expired</td>
                           <td>{{$airhq_date_expired_product}}</td>
                           <td>{{$bsr_date_expired_product}}</td>
                           <td>{{$bbd_date_expired_product}}</td>
                           <td>{{$mtr_date_expired_product}}</td>
                           <td>{{$zhr_date_expired_product}}</td>
                           <td>{{$pkp_date_expired_product}}</td>
                           <td>{{$cxb_date_expired_product}}</td>
                           <td>{{$airhq_date_expired_product + $bsr_date_expired_product + $bbd_date_expired_product + $mtr_date_expired_product + $zhr_date_expired_product + $pkp_date_expired_product + $cxb_date_expired_product}}</td>
                        </tr>
                 
                       </tbody>
                   </table> 
                </div>   
               
            </div>
      </div>

      <div class="col-xs-2 col-sm-2 col-md-2" style="border:4px solid gray; margin-left:12px;">
         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:7px;">
                  <table class="table">
                        <thead style="background-color:red;">
                           <tr>
                             <th style="text-align:center; color:#fff;">Top Selling Items</th>
                           </tr>
                        </thead>

                        <tbody>
                         @foreach($overall_top_selling_product as $overall_top_selling_product)
                         <tr style="font-weight:bold;">
                           <td style="text-align:center;">{{$overall_top_selling_product->medicine_name}}</td>
                         </tr>
                         @endforeach
                        </tbody>
                  </table>     
            </div>
         </div>
      </div>


   </div>
   @endcan

</div>


@endsection



<style type="text/css">

.blink_me {
  animation: blinker 1s linear infinite;
  color:red;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

</style>
