@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">

            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12">
                        <span style="text-align:left; font-family:arial;font-weight:bold;color:blue;">Product Edit</span>                     
                    </div>
                </nav>
            </div>


            <div class="card-body">
               
                <form  action="{{ route('products.update',$product->id) }}"  method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

                <div class="row">

                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Manufacturer company:</strong>
                         <input type="text" name="manufacturer_company" class="form-control" value="{{ $product->manufacturer_company }}" placeholder="auto unique code">
                        </div>
                    </div>


                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Product Category:</strong>                  
                         <select class="form-control" name="product_category" id="product_category">
                         <option value="{{ $product->product_category }}">{{ $product->product_category }}</option>	
                          @foreach ($medicine_cat as $medicine_cat)
                          <option value="{{ $medicine_cat->category_name }}">{{ $medicine_cat->category_name }}</option>				  
                          @endforeach
                         </select>
                        </div>
                    </div>

                </div> 

                <div class="row">   

                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Product Group:</strong>                  
                        <select class="form-control" name="product_group" id="product_group">
                            <option value="{{ $product->product_group }}">{{ $product->product_group }}</option>          
                            <option value="Medicine">Medicine</option>
                            <option value="Food">Food</option>
                            <option value="Supplement">Supplement</option>
                            <option value="Medical Device">Medical Device</option>
                        </select>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Product Name:</strong>
                         <input type="text" name="medicine_name" class="form-control" value="{{ $product->medicine_name }}" placeholder="product name">
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Generic Name:</strong>
                         <input type="text" name="generic_name" class="form-control" value="{{ $product->generic_name }}" placeholder="Generic name">
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Strength (unit of measurement) :</strong>
                         <input type="text" name="strength" class="form-control" value="{{ $product->strength }}" placeholder="500mg/10g/0.5ltr...">
                        </div>
                    </div>

                </div> 

                @foreach ($product_price as $product_price)
                <div class="row">

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Purchase Price with vat (Tk):</strong>
                        <input type="hidden" name="purchase_price_old" class="form-control" value="{{ $product_price->purchase_price }}"> 
                        <input type="number" name="purchase_price" class="form-control" value="{{ $product_price->purchase_price }}" placeholder="purchase price">                       
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Sales Price with vat (Tk):</strong>
                        <input type="hidden" name="sales_price_old" class="form-control" value="{{ $product_price->sales_price }}"> 
                        <input type="number" name="sales_price" class="form-control" value="{{ $product_price->sales_price }}" placeholder=" Sales price">                       
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Vat Rate (%):</strong>
                        <input type="hidden" name="vat_rate_old" class="form-control" value="{{ $product_price->vat_rate }}"> 
                        <input type="number" name="vat_rate" class="form-control" value="{{ $product_price->vat_rate }}" placeholder=" vat rate">                       
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Discount Rate (Tk):</strong>
                        <input type="hidden" name="discount_rate_old" class="form-control" value="{{ $product_price->discount_rate }}">
                        <input type="number" name="discount_rate" class="form-control" value="{{ $product_price->discount_rate }}" placeholder="discount rate">                       
                        </div>
                    </div>

                </div>          
                @endforeach

                      
                <div class="row">

                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Start Date:</strong>
                        <input type="date" name="start_date" class="form-control" value="{{date('Y-m-d', strtotime('+0 day'))}}">                       
                        </div>
                    </div>
                    
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                        <strong>Base Name:</strong>
                        <select class="form-control" name="base_name" id="base_name">
                            <option value="{{ $product->base_name }}">{{ $product->base_name }}</option>
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

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <strong>Remarks:</strong>
                          <input type="text" name="remarks" class="form-control"  value="{{ $product->remarks }}" placeholder="remarks"/> 
                        </div>
                    </div>

                </div>

            
                </br>
                <div class="row">	
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      @can('product-list-edit')
                      <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save?')">Submit</button>
                      @endcan
                    </div>
                </div>


                </form>

            </div>


            
        </div>
    </div>
@endsection

