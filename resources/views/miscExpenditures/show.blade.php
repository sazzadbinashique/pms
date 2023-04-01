@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">          
             &nbsp;<span style="font-family:arial;font-weight:bold;"><i class="fa fa-barcode"></i>&nbsp;Misc Expense Details</span>
        </div>
    </div></br>


    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Expense Amount : </strong>
                {{$miscExpenditure->expense_amount}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Description : </strong>
                {{$miscExpenditure->description}}
            </div>
        </div>
    </div>      


    <div class="row">           
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Start Date : </strong>
                {{ $miscExpenditure->start_date }}
            </div>
        </div>    
        
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;End Date : </strong>
                {{ $miscExpenditure->end_date }}
            </div>
        </div>  
    </div>

    <div class="row">           
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Base Name : </strong>
                {{ $miscExpenditure->base_name }}
            </div>
        </div>    
        
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Remarks : </strong>
                {{ $miscExpenditure->remarks }}
            </div>
        </div>  
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created By : </strong>
                {{ $miscExpenditure->created_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created Date (yyyy/mm/dd) : </strong>
                {{ $miscExpenditure->created_at }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified By : </strong>
                {{ $miscExpenditure->updated_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified Date (yyyy/mm/dd) : </strong>
                {{ $miscExpenditure->updated_at }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="pull-right">
            <!-- <a class="btn btn-primary btn-sm" href=" "> Back</a> -->
        </div>
    </div>

@endsection