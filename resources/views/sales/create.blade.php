@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">

            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12">
                    <span style="text-align:left; font-family:arial;font-weight:bold;color:blue;">Add New sale</span>         
                    </div>
                </nav>
            </div>

            <div class="card-body">
            <span style="color:red; font-weight:bold;">Note : No sales price, Date expired, Stock Quantity 0 &nbsp;Products are  not available for sales !!!</span>

            <form  action="{{ route('sales.store') }}"  method="POST">
                @csrf

                <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="total_sales_amount" id="total_sales_amount">
                <input type="hidden" name="total_discount_amnt" id="total_discount_amnt">
             

                <div class="row">

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Customer Name:</strong>
                         <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="name">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                        <strong>Customer Mobile:</strong>
                         <input type="text" name="customer_mobile" id="customer_mobile" class="form-control" placeholder="mobile">
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                        <strong>Doctor/ Specialist:</strong>
                         <input type="text" name="doctor_name" id="doctor_name" class="form-control" value="self" placeholder="doctor name">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                         <strong>Product Name:</strong>
                         <select class="form-control" name="medicine_name" id="medicine_name" onchange="getPrice()">
                         <option value="">Select One</option>
                          @foreach ($stock_list as $stock_list)
                          <option value="{{ $stock_list->product_id }}">{{ $stock_list->medicine_name }} {{ $stock_list->strength }}</option>
                          @endforeach
                         </select>
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                        <strong>Quantity:</strong>
                         <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" placeholder="quantity">
                         <input type="hidden" name="product_id" id="product_id" class="form-control">
                         <input type="hidden" name="price_id" id="price_id" class="form-control">
                         <input type="hidden" name="purchase_price" id="purchase_price" class="form-control">
                         <input type="hidden" name="sales_price" id="sales_price" class="form-control">
                         <input type="hidden" name="discount_rate" id="discount_rate" class="form-control">             
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                         <button class="btn btn-primary btn-sm" style="margin-top:30px;" type="button" onclick="addMedicine()"> + Add to List</button>
                        </div>
                    </div>
                </div>

                </br></br>
                <div class="row">
                    <h3 class="text-success" id="success_txt"></h3>
                    <table class="table table-striped" id="mytable" style="font-weight:bold;">
                    <thead>
                        <tr>
                        <th scope="col"style="font-weight:bold;">Product</th>
                        <th scope="col"style="font-weight:bold;">Qty</th>
                        <th scope="col"style="font-weight:bold;">Price (Vat Included)</th>
                        <th scope="col"style="font-weight:bold;">Amount</th>
                        <th scope="col"style="font-weight:bold;">Discount (Per Unit)</th>
                        <th scope="col"style="font-weight:bold;">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                    </table>
                </div>

                </br>
                <div class="row">
                     <div class="grand_final" style="margin-left:53%;">
                        <h5 id='grand'></h5>  
                        <h5 id='total_discount'></h5>  
                        <h5 id='sub_total' style="color:red;"></h5>
                        <!-- <h5 id='grand'></h5><p class="vat"> with vat(10%)</p>                    -->
                     </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      @can('pos-create')
                      <button type="button" onclick="getPay()" class="btn btn-primary btn-lg" onclick="return confirm('Are you sure you want to save?')">Pay</button>
                      @endcan
                    </div>
                </div>


                </form>

            </div>

        </div>
    </div>
@endsection

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('auto-search/css/select2.min.css')}}">
@endsection

@section('third_party_scripts')

    <script src="{{ asset('auto-search/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
        $('#medicine_name').select2();
       });
    </script>
@endsection

