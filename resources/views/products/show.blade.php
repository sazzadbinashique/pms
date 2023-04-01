@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">          
             &nbsp;<span style="font-family:arial;font-weight:bold;"><i class="fa fa-barcode"></i>&nbsp;Product Details</span>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6" style="text-align:right;">
            @can('product-list-edit')
            <a class="btn btn-success text-white btn-sm" href="{{route('products.edit',$product->id)}}">
                <button>Edit Product</button>
            </a>    
            @endcan 
        </div>
    </div></br>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Product Group : </strong>
                {{$product->product_group}}
            </div>
        </div> 

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Product Category : </strong>
                {{$product->product_category}}
            </div>
        </div>
    </div>  


    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Product Name : </strong>
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
                <strong>&nbsp;Strength : </strong>
                {{$product->medicine_name}}
            </div>
        </div>   

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Manufacturer Company : </strong>
                {{$product->medicine_name}}
            </div>
        </div> 
    </div>

    @foreach($current_price as $current_price)
    <div class="row">                   
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Current Purchase Price : </strong>
                {{$current_price->purchase_price}} Tk
            </div>
        </div>  

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Current Sales Price : </strong>
                {{$current_price->sales_price}} Tk
            </div>
        </div>  
    </div>
    

    <div class="row"> 
       <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Discount Rate : </strong>
                {{$current_price->discount_rate}}  Tk
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Current Vat Rate : </strong>
                {{$current_price->vat_rate}} %
            </div>
        </div>    
    </div>
    @endforeach

    <div class="row">                   
        <!-- <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>&nbsp;Base Name : </strong>
                {{ $product->base_name }}
            </div>
        </div>   -->

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
                @if($product->created_at){{ date('d M Y', strtotime($product->created_at)) }}@endif
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
                @if($product->updated_at){{ date('d M Y', strtotime($product->updated_at)) }}@endif
            </div>
        </div>
    </div>

    </br>
    <b>Price Record : </b>
    <div class="row">                   
        <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table table-hover table-striped" id="sales_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Product Name</th>
                            <th>Purchase Price (Tk)</th>
                            <th>Sales Price (Tk)</th>
                            <th>Discount Rate (Tk)</th>
                            <th>Vat Rate (%)</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Updated Time</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $x = 0; ?>
                        @foreach($price_dtls as $key=>$data)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle">{{$data->medicine_name}}</td> 
                                <td class="align-middle">{{$data->purchase_price}}</td>    
                                <td class="align-middle">{{$data->sales_price}}</td>   
                                <td class="align-middle">{{$data->discount_rate}}</td>  
                                <td class="align-middle">{{$data->vat_rate}}</td>           
                                <td class="align-middle">{{ date('d M Y', strtotime($data->start_date)) }}</td> 
                                <td class="align-middle">@if($data->end_date){{ date('d M Y', strtotime($data->end_date)) }}@endif</td> 
                                <td class="align-middle">
                                    @if($data->status =='Active')
                                    <span style="color:green;">{{ $data->status }}</span>
                                    @else
                                    {{ $data->status }}
                                    @endif                               
                                </td>  
                                <td class="align-middle">@if($data->updated_at){{ date('d M Y', strtotime($data->updated_at)) }}@endif</td>                                                                            
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