@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">

            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12">
                    <span style="text-align:left; font-family:arial;font-weight:bold;color:blue;">Add New Product</span>         
                    </div>
                </nav>
            </div>

            <div class="card-body">
               
                <form  action="{{ route('products.store') }}"  method="POST">
                @csrf

                <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">

                <div class="row">

                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Product Code:</strong>
                         <input type="text" name="product_code" class="form-control" placeholder="Product code">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Medicine Category:</strong>                  
                         <select class="form-control" name="medicine_category" id="medicine_category">
                         <option value="">Select One</option>	
                          @foreach ($medicine_cat as $medicine_cat)
                          <option value="{{ $medicine_cat->category_name }}">{{ $medicine_cat->category_name }}</option>				  
                          @endforeach
                         </select>
                        </div>
                    </div>
                </div>  

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Medicine Name:</strong>
                         <input type="text" name="medicine_name" class="form-control" placeholder="medicine name">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Generic Name:</strong>
                         <input type="text" name="generic_name" class="form-control" placeholder="Generic name">
                        </div>
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Purchase Price:</strong>
                        <input type="number" name="price" class="form-control" placeholder=" Purchase price">                       
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Sales Price:</strong>
                        <input type="number" name="sales_price" class="form-control" placeholder=" Sales price">                       
                        </div>
                    </div>

                </div> 


                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Base Name:</strong>
                        <select class="form-control" name="base_name" id="base_name">
                            <option value="">Select One</option>
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
                          <input type="text" name="remarks" class="form-control"  placeholder="remarks"/> 
                        </div>
                    </div>

                </div> 


                </br>
                <div class="row">	
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save?')">Submit</button>
                    </div>
                </div>


                </form>

            </div>

        </div>
    </div>
@endsection

