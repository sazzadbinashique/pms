@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">          
             &nbsp;<span style="font-family:arial;font-weight:bold;"><i class="fa fa-barcode"></i>&nbsp;Medicine Category Details</span>
        </div>
    </div></br>


    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Category Name : </strong>
                {{$medicineCategory->category_name}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Description : </strong>
                {{$medicineCategory->description}}
            </div>
        </div>
    </div>      


    <div class="row">           
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Status : </strong>
                {{ $medicineCategory->status }}
            </div>
        </div>    
        
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Remarks : </strong>
                {{ $medicineCategory->remarks }}
            </div>
        </div>  
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created By : </strong>
                {{ $medicineCategory->created_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created Date (yyyy/mm/dd) : </strong>
                {{ $medicineCategory->created_at }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified By : </strong>
                {{ $medicineCategory->updated_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified Date (yyyy/mm/dd) : </strong>
                {{ $medicineCategory->updated_at }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="pull-right">
            <!-- <a class="btn btn-primary btn-sm" href=" "> Back</a> -->
        </div>
    </div>

@endsection