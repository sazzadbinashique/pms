@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">          
             &nbsp;<span style="font-family:arial;font-weight:bold;"><i class="fa fa-barcode"></i>&nbsp;Medicine Details</span>
        </div>
    </div></br>


    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Code : </strong>
                {{$product->product_code}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Medicine Category : </strong>
                {{$product->medicine_category}}
            </div>
        </div>
    </div>      


    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Medicine Name : </strong>
                {{$product->medicine_name}}
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Generic Name : </strong>
                {{$product->generic_name}}
            </div>
        </div>  
    </div>


    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Price : </strong>
                {{$product->price}}
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Sales Price : </strong>
                {{$product->sales_price}}
            </div>
        </div>  
    </div>

    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Base Name : </strong>
                {{ $product->base_name }}
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Remarks : </strong>
                {{ $product->remarks }}
            </div>
        </div>  
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created By : </strong>
                {{ $product->created_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created Date (yyyy/mm/dd) : </strong>
                {{ $product->created_at }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified By : </strong>
                {{ $product->updated_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified Date (yyyy/mm/dd) : </strong>
                {{ $product->updated_at }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="pull-right">
            <!-- <a class="btn btn-primary btn-sm" href=" "> Back</a> -->
        </div>
    </div>

@endsection