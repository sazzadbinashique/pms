@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8">          
             &nbsp;<span style="font-family:arial;font-weight:bold;"><i class="fa fa-barcode"></i>&nbsp;Sales Details</span>
        </div>

        
        
        <div class="col-xs-2 col-sm-2 col-md-2" style="text-align:right;">
            @can('pos-create') 
             <a class="btn btn-info text-black btn-md" href="/generate-pdf/{{$sale->id}}" style="font-weight:bold;">
             Generate Invoice
            </a> 
            @endcan
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2" style="text-align:right;">
            @can('pos-create')
            <a class="btn btn-danger text-black btn-md" href="{{route('sales.create')}}" style="font-weight:bold;">
                Create new sale
            </a>     
            @endcan
        </div>
    </div></br>

     @if(!empty(request()->message))
        <div class="alert alert-success">
            {{request()->message}}
        </div>
    @endif
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Customer Name : </strong>
                {{$sale->customer_name}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Customer Mobile : </strong>
                {{$sale->customer_mobile}}
            </div>
        </div>
    </div> 
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Doctor / Specialist Name : </strong>
                {{$sale->doctor_name}}
            </div>
        </div> 
    </div> 


    <div class="row">  
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Sales Invoice : </strong>
                {{ $sale->id }}
            </div>
        </div>                 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Base Name : </strong>
                {{ $sale->base_name }}
            </div>
        </div>  
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created By : </strong>
                {{ $sale->created_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Sales Date: </strong>
                {{ date('d M Y', strtotime($sale->created_at)) }}
            </div>
        </div>
    </div>

    </br>
    <div class="row">                   
        <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table table-hover table-striped" id="sales_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price Per Unit (Tk)</th>
                            <th>Sales Amount (Tk)</th>
                            <th>Discount Per Unit (Tk)</th>
                            <th>Discount Amount (Tk)</th>
                            <th>Payable Amount</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $x = 0; $y=0; ?>
                        @foreach($sales_details as $key=>$data)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle">{{$data->medicine_name}}</td> 
                                <td class="align-middle">{{$data->quantity}}</td>         
                                <td class="align-middle">{{$data->sales_price}}</td> 
                                <td class="align-middle">{{$data->sales_amount }}</td>   
                                <td class="align-middle">{{$data->discount_rate }}</td>  
                                <td class="align-middle">{{$data->discount_rate * $data->quantity}}</td> 
                                <td></td>                                                                       
                            </tr>     
                            @php  $x += $data->sales_amount  @endphp
                            @php  $y += $data->discount_rate * $data->quantity @endphp                
                        @endforeach
                            <tr>
                                <td></td>
                                <td></td> 
                                <td></td>         
                                <td></td> 
                                <td style="color:red; font-weight:bold;"> Total Amount : {{ $x }} Tk</td>  
                                <td></td> 
                                <td style="color:red; font-weight:bold;">Total Discount : {{ $y }} Tk</td>     
                                <td style="color:red; font-weight:bold;">Payable : {{ $x - $y }} Tk</td>                                                                            
                            </tr>
                        </tbody>

                    </table>
        </div>
    </div>
    
    
    <div class="row">
        <div class="pull-right">
            <!-- <a class="btn btn-primary btn-sm" href=" "> Back</a> -->
        </div>
    </div>

@endsection