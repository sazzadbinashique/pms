@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">

            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12">
                    <span style="text-align:left; font-family:arial;font-weight:bold;color:blue;">Add New Stock</span>         
                    </div>
                </nav>
            </div>

            <div class="card-body">
                <span style="color:red; font-weight:bold;">Note : Product sales price mendatory, otherwise not available for stock receive !!!</span>

                <form  action="{{ route('inventories.store') }}"  method="POST">
                @csrf

                <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="updated_at" value="{{ now()->format('Y-m-d H:i:s') }}">
                <input type="hidden" name="medicine_name" id="medicine_name">
                <input type="hidden" name="product_id" id="product_id">
                <input type="hidden" name="product_category" id="product_category">
                <input type="hidden" name="generic_name" id="generic_name">
                <input type="hidden" name="strength" id="strength">

                <div class="row">

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" id="product_name_search" class="form-control"  oninput="get_auto_suggestion_product_id()" placeholder="product name">   
                        <select class="form-control" id="product_name_select">

                        </select>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                        <strong>Quantity:</strong>
                        <input type="number" name="quantity" class="form-control" placeholder="quantity">                       
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                        <strong>Base Name:</strong>
                        <select class="form-control" name="base_name" id="base_name">
                            <option value="{{ Auth::user()->base_name }}">{{ Auth::user()->base_name }}</option>
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

                </div> 

                      
                <div class="row">

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                          <strong>Expiry Date:</strong>
                          <input type="date" name="expiry_date" class="form-control" placeholder="expiry_date">                         
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                          <strong>Chalan/Reference No: * </strong>
                          <input type="text" name="chalan_invoice_no" class="form-control"  placeholder="chalan / reference no"/> 
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                          <strong>Remarks:</strong>
                          <input type="text" name="remarks" class="form-control"  placeholder="remarks"/> 
                        </div>
                    </div>
                </div>
          

                </br>
                <div class="row">	
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      @can('stock-list-create')
                      <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save?')">Submit</button>
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

    <script>
        function get_auto_suggestion_product_id()
       {

        let product_name = $('#product_name_search').val();    

        $.ajax({
          url: "{{route('getAutoSuggestProductId.name')}}",
          type: "post",
          data:{
            product_name:product_name,
            _token: '{{csrf_token()}}'
          },
          success:function(response){
               $('#product_name_select').html(response);
          }

         });
        }

    </script>

    <script>
        $(document).ready(function() {

        $('#product_name_select').on('change', function () {
        var product_id = this.value;

        $.ajax({
            url: "{{route('getInvntryProductNameById')}}",
            type: "post",
            data:{
                product_id:product_id,
                _token: '{{csrf_token()}}'
            },
            success:function(response){

                var obj = JSON.parse(response);
                $('#product_id').val(product_id);
                $('#medicine_name').val(obj.medicine_nm);
                $('#product_category').val(obj.product_cat);
                $('#generic_name').val(obj.generic_nm);
                $('#strength').val(obj.strength_nm);
            }

         });

        
       });

       });
    </script>
@endsection


