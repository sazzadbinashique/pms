@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">          
             &nbsp;<span style="font-family:arial;font-weight:bold;"><i class="fa fa-barcode"></i>&nbsp;Stock Details</span>
        </div>
    </div></br>


    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Product Name : </strong>
                {{$inventory->medicine_name}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Product Category : </strong>
                {{$inventory->product_category}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Generic Name : </strong>
                {{$inventory->generic_name}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Strength : </strong>
                {{$inventory->strength}}
            </div>
        </div> 
    </div>    
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Stock In : </strong>
                {{$inventory->quantity}}
            </div>
        </div>
    </div>  


    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Stock Out : </strong>
                {{$inventory->stock_out_quantity}}
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Available Stock : </strong>
                {{$inventory->quantity - $inventory->stock_out_quantity}}
            </div>
        </div>  
    </div>

    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Purchase Price : </strong>
                @foreach($price_info as $price_info){{ $price_info->purchase_price }}
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Sales Price : </strong>
                {{ $price_info->sales_price }}
            </div>
        </div>  
    </div>

    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Discount  Rate (%) : </strong>
                {{ $price_info->discount_rate }}
                @endforeach
            </div>
        </div>  
    </div>

    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Expiry Date : </strong>
                {{ date('d M Y', strtotime($inventory->expiry_date)) }}
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Base Name : </strong>
                {{ $inventory->base_name }}
            </div>
        </div>  
    </div>


    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Chalan/Reference No : </strong>
                {{ $inventory->chalan_invoice_no }}
            </div>
        </div>  
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Remarks : </strong>
                {{ $inventory->remarks }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created By : </strong>
                {{ $inventory->created_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Created Date : </strong>
                {{ date('d M Y', strtotime($inventory->created_at)) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified By : </strong>
                {{ $inventory->updated_by }}
            </div>
        </div>
            
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Modified Date : </strong>
                {{ date('d M Y', strtotime($inventory->updated_at)) }}
            </div>
        </div>
    </div>

    </br>
    <b>Stock Previous Record : </b>
    <div class="row">                   
        <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table table-hover table-striped" id="sales_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Product Name</th>
                            <th>Chalan/Invoice No</th>
                            <th>Opening Qty</th>
                            <th>Qty</th>
                            <th>Present Qty</th>
                            <th>Transaction Type</th>
                            <th>Expiry Date</th>
                            <th>Remarks</th>
                            <th>Invoice Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $x = 0; ?>
                        @foreach($invent_details as $key=>$data)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle">{{$data->medicine_name}}</td> 
                                <td class="align-middle"></td> 
                                <td class="align-middle">{{$data->quantity}}</td>    
                                <td class="align-middle">{{$data->add_remove_qty}}</td>   
                                <td class="align-middle">
                                    @if($data->transction_type =='Adjust')
                                    {{$data->quantity - $data->add_remove_qty}}
                                    @elseif($data->transction_type =='Receive')
                                    {{$data->add_remove_qty + $data->quantity}}
                                    @else
                                    @endif

                                </td> 
                                <td class="align-middle">{{$data->transction_type}}</td>           
                                <td class="align-middle">{{ date('d M Y', strtotime($data->expiry_date)) }}</td> 
                                <td class="align-middle">{{$data->remarks }}</td>  
                                <td class="align-middle">{{ date('d M Y', strtotime($data->trigger_time)) }}</td>                                                                            
                            </tr>                   
                        @endforeach
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