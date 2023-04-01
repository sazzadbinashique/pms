@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">

            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12">
                        <span style="text-align:left; font-family:arial;font-weight:bold;color:blue;">Edit Stock</span>                     
                    </div>
                </nav>
            </div>


            <div class="card-body">
               
                <form  action="{{ route('inventories.update',$inventory->id) }}"  method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

                <div class="row">
                    <span style="color:red;">Note -> Stock In : {{ $inventory->quantity }},  &nbsp;&nbsp;Stock Out : {{ $inventory->stock_out_quantity }},  &nbsp;&nbsp;Available Stock : {{ $inventory->quantity - $inventory->stock_out_quantity }}</span>
                    
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Product Name:</strong>
                         <input type="text" name="medicine_name" class="form-control" value="{{ $inventory->medicine_name }}" placeholder="product name">
                         <input type="hidden" name="product_id" class="form-control" value="{{ $inventory->product_id }}">
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Stock In Qty:</strong>
                        <input type="number" name="quantity" class="form-control" value="{{ $inventory->quantity }}" placeholder="">                       
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Transaction Type:</strong>
                        <select class="form-control" name="transction_type">                          
                            <option value="Receive">Receive</option>
                            <option value="Adjust">Adjust</option>
                        </select>                       
                        </div>
                    </div> 

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>New Quantity:</strong>
                        <input type="number" name="add_remove_qty" class="form-control" value="" placeholder="">                       
                        </div>
                    </div>

                </div> 

                      
                <div class="row">

                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Base Name:</strong>
                        <select class="form-control" name="base_name" id="base_name">
                            <option value="{{ $inventory->base_name }}">{{ $inventory->base_name }}</option>
                            <option value="Air HQ (U)">Air HQ (U)</option>
                            <option value="BAF BSR">BAF BSR</option>
                            <option value="BAF BBD">BAF BBD</option>
                            <option value="BAF MTR">BAF MTR</option>
                            <option value="BAF ZHR">BAF ZHR</option>
                            <option value="BAF PKP">BAF PKP</option>
                            <option value="BAF CXB">BAF CXB</option>
                        </select>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                          <strong>Expiry Date:</strong>
                          <input type="date" name="expiry_date" class="form-control" value="{{ $inventory->expiry_date }}" placeholder="expiry_date">                         
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                          <strong>Chalan/Reference No: * </strong>
                          <input type="text" name="chalan_invoice_no" class="form-control"  value="{{ $inventory->chalan_invoice_no }}"  placeholder="chalan / reference no"/> 
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                          <strong>Remarks:</strong>
                          <input type="text" name="remarks" class="form-control"  value="{{ $inventory->remarks }}" placeholder="remarks"/> 
                        </div>
                    </div>
                </div>
            
                </br>
                <div class="row">	
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      @can('stock-list-edit')
                      <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save?')">Submit</button>
                      @endcan
                    </div>
                </div>


                </form>

            </div>


            
        </div>
    </div>
@endsection

