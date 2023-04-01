
@extends('layouts.app')

@section('title','')

@section('content')

    <div class="container-fluid px-0">
        <div class="card mb-3">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills justify-content-between">
                    <li class="nav-item" style="font-family:arial;font-weight:bold;"><i class="fa fa-registered" style="font-size:14px;color:black">&nbsp;</i>Date Expired Products Report</li>
                </ul>
            </div>

            @if ($message = Session::get('success'))
            <div class="alert alert-success"><p>{{ $message }}</p></div>
            @endif

            <div class="card-body">
                @if($errors->count() > 0)
                    <ul class="list-group notification-object">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ url('/search_date_expired_product') }}" method="GET">
                <div class="row">
                  <div class="col-xs-2 col-sm-2 col-md-2">         
                    <select class="form-control" name="base_name" id="base_name" style="background-color:#f4f6f9; border:1px solid #4B92f9;">
                      <option value="">Select Base Name</option>		
                      <option value="Air HQ (U)">Air HQ (U)</option>
                      <option value="BAF BSR">BAF BSR</option>
                      <option value="BAF BBD">BAF BBD</option>
                      <option value="BAF MTR">BAF MTR</option>
                      <option value="BAF ZHR">BAF ZHR</option>
                      <option value="BAF PKP">BAF PKP</option>
                      <option value="BAF CXB">BAF CXB</option>
                     </select>                
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2">         
                    <select class="form-control" name="product_group" id="product_group" style="background-color:#f4f6f9; border:1px solid #4B92f9;"> 
                        <option value="">product group</option>	           
                        @foreach ($date_expired_prod_grp as $date_expired_prod_grp)
                        <option value="{{ $date_expired_prod_grp->product_group }}">{{ $date_expired_prod_grp->product_group }}</option>				  
                        @endforeach
                    </select>               
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2">         
                    <select class="form-control" name="product_category" id="product_category" style="background-color:#f4f6f9; border:1px solid #4B92f9;">
                        <option value="">product category</option>		
                        @foreach ($date_expired_prod_catg as $date_expired_prod_catg)
                        <option value="{{ $date_expired_prod_catg->product_category }}">{{ $date_expired_prod_catg->product_category }}</option>				  
                        @endforeach
                    </select>                
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2">         
                    <select class="form-control" name="medicine_name" id="medicine_name" style="background-color:#f4f6f9; border:1px solid #4B92f9;">
                        <option value="">product name</option>		
                        @foreach ($date_expired_prod_name as $date_expired_prod_name)
                        <option value="{{ $date_expired_prod_name->medicine_name }}">{{ $date_expired_prod_name->medicine_name }}</option>				  
                        @endforeach
                    </select>                
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2">         
                    <select class="form-control" name="generic_name" id="generic_name" style="background-color:#f4f6f9; border:1px solid #4B92f9;">
                        <option value="">generic name</option>		
                        @foreach ($date_expired_prod_generic_name as $date_expired_prod_generic_name)
                        <option value="{{ $date_expired_prod_generic_name->generic_name }}">{{ $date_expired_prod_generic_name->generic_name }}</option>				  
                        @endforeach
                    </select>                
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2">
                    <button type="submit" style="height:36px; font-weight:bold; background-color:#f4f6f9; border:1px solid #4B92f9;">Search</button>
                  </div>
                
                </div>
              </form>
              <span style="font-size:14px;color:blue;">@if($searchchk==1)search completed. please check data table @endif<span>
              </br></br>
          

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="date_expired_rpt_tbl">
                        <thead class="table-dark">
                        <tr>
                        <th>Ser</th>
                        <th>Product Name</th>
                        <th>Generic Name</th>
                        <th>Product Group</th>         
                        <th>Product Category</th>
                        <th>Stock Receive Date</th>
                        <th>Expiry Date</th>         
                        <th>Stock Available Qty</th>
                        <th>Base Name</th> 
                        </tr>
                        </thead>

                        <tbody>
                          @foreach($date_expired_products as $key=> $data)
                          <tr>
                          <td>{{ ++$key }}</td>                     
                          <td>{{ $data->medicine_name }}</a></td>
                          <td>{{ $data->generic_name }}</td>
                          <td>{{ $data->product_group }}</td>
                          <td>{{ $data->product_category }}</td>
                          <td>{{ $data->created_at}}</td>      
                          <td>{{ $data->expiry_date }}</td>
                          <td>{{ $data->quantity - $data->stock_out_quantity}}</td>
                          <td>{{ $data->base_name }}</td>                                 
                          </tr>
                          @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection



<!-- this 2 css only for report -->

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('report-generate/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('report-generate/css/buttons.dataTables.min.css')}}">
@endsection

@section('third_party_scripts')

    <script src="{{ asset('report-generate/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('report-generate/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('report-generate/js/jszip.min.js') }}"></script>
    <script src="{{ asset('report-generate/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('report-generate/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('report-generate/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('report-generate/js/buttons.print.min.js') }}"></script>

    <script>
 
      let url = "{{ route('date_expired_report') }}";
      $(document).ready(function(){
        
      //$.noConflict();


      var date = new Date();
      var formateDt = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '-' + date.getFullYear();

      $('#date_expired_rpt_tbl').DataTable( {
      
            dom: 'Bfrtip',
            buttons: [
                      { extend : 'copy', filename: 'Date Expired Products Report' },
                      { extend : 'csv', filename: 'Date Expired Products Report' },
                      { extend : 'excel', filename: 'Date Expired Products Report',
                                  title:'Report, ' + '\n' + ' Date Expired Products, ' + '\n' +' Date :' + formateDt
                      },
                      { extend : 'pdf', orientation: '', pageSize: 'LEGAL', filename: 'Date Expired Products Report',
                                  customize:function(doc){doc.defaultStyle.alignment = 'left'; doc.styles.tableHeader.alignment = 'left';
                                    doc.content.splice( 0, 0, {
                                        margin: [ 0, 0, 0, 12 ],
                                        alignment: 'center',
                                        image:'data:image/png;base64,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'
                                    } );
                                  },    
                                  title:'Report' + '\n' + 'Date Expired Products' + '\n' +  'Date : ' + formateDt
                      },
                      { extend : 'print', title:'Date Expired Products Report' },
            ],    
            'pageLength': 10

        } );

      });

    </script>
@endsection

<!-- end this 2 css only for report -->


