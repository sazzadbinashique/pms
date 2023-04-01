@extends('layouts.app')

@section('title','')

@section('content')

    <div class="container-fluid px-0">
        <div class="card mb-3">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills justify-content-between">
                    <li class="nav-item" style="font-family:arial;font-weight:bold;">Stock List</li>
                    @can('stock-list-create')
                        <li class="nav-item"><a class="btn btn-success text-white btn-md" href="{{route('inventories.create')}}">
                            <svg class="icon me-2 text-white">
                                <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                            </svg>Receive New Stock</a>
                        </li>
                    @endcan

                </ul>
            </div>

            <form action="{{ url('/getInventoryProduct') }}" method="GET">
                <div class="row" style="margin-left:5px; margin-top:7px;">

                <div class="col-xs-3 col-sm-3 col-md-3">      
                     <input type="text" id="product_name_search" class="form-control"  oninput="get_auto_suggestion_invntry_product()" placeholder="please type product name">   
                     <select class="form-control" name="medicine_name" id="product_name_select">

                     </select>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3">    
                     <input type="text" id="generic_name_search" class="form-control"  oninput="get_auto_suggestion_invntry_generic()" placeholder="please type generic name">   
                     <select class="form-control" name="generic_name" id="generic_name_select">

                     </select>     
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2">
                    <button type="submit" style="height:25px; font-weight:bold; margin-top:42px; background-color:#f4f6f9; border:1px solid #4B92f9;">Search</button>
                    </div>
                
                </div>
            </form>


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

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="medicine_inventory_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Product Category</th>
                            <th>Product Name</th>
                            <th>Generic Name</th>
                            <th>Strength</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Available Stock</th>
                            <th>Expiry Date</th>
                            <th>Base Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody style="font-weight:bold;">
                        @foreach($inventories as $key=>$data)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle">{{$data->product_category}}</td>
                                <td class="align-middle">{{$data->medicine_name}}</td>
                                <td class="align-middle">{{$data->generic_name}}</td>
                                <td class="align-middle">{{$data->strength}}</td>
                                <td class="align-middle">{{$data->quantity}}</td>
                                <td class="align-middle">{{$data->stock_out_quantity}}</td>  
                                <td class="align-middle">{{$data->quantity - $data->stock_out_quantity}}</td>   
                                <td class="align-middle">{{ date('d M Y', strtotime($data->expiry_date)) }}</td>   
                                <td class="align-middle">{{$data->base_name}}</td>                         
                                <td class="text-center align-middle">
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <a class="btn btn-info text-white btn-sm" href="{{ route('inventories.show',$data->id) }}">Details</a>

                                        @can('stock-list-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('inventories.edit',$data->id) }}">Edit</a>
                                        @endcan

                                        @can('stock-list-delete')
                                        <form action="{{ route('inventories.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger text-white btn-sm" type="submit"  onclick="return confirm('Are you sure you want to Delete this?')">Delete</button>
                                        </form>
                                        @endcan

                                    </div>
                                </td>
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
    
    let url = "{{ route('inventories.index') }}";
    $('#medicine_inventory_tbl').DataTable( {

            //dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'pageLength': 10
        } );


    </script>

    <script>
        function get_auto_suggestion_invntry_product()
       {

        let product_name = $('#product_name_search').val();    

        $.ajax({
          url: "{{route('getAutoSuggestInvntryProduct.name')}}",
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


        function get_auto_suggestion_invntry_generic()
       {

        let generic_name = $('#generic_name_search').val();    

        $.ajax({
          url: "{{route('getAutoSuggestInvntryGeneric.name')}}",
          type: "post",
          data:{
            generic_name:generic_name,
            _token: '{{csrf_token()}}'
          },
          success:function(response){
               $('#generic_name_select').html(response);
          }

         });
        }

    </script>

@endsection

<!-- end this 2 css only for report -->


@section('language-filter-js')
    <script>
        // alertify delete
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            alertify.confirm('Whoops!', 'Are you sure you want to Delete?',
                function(){
                    form.submit();
                    // alertify.success('Ok')
                },
                function(){
                    // alertify.error('Cancel')
                });
        });

        $(document).ready(function() {
            $('#role').DataTable();
        } );
    </script>
@endsection

