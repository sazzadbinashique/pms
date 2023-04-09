@extends('layouts.app')

@section('title','')

@section('content')

    <div class="container-fluid px-0">
        <div class="card mb-3">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills justify-content-between">
                    <li class="nav-item" style="font-family:arial;font-weight:bold;">Product List</li>
                    @can('product-list-create')
                        <li class="nav-item"><a class="btn btn-success text-white btn-sm" href="{{route('products.create')}}">
                                <svg class="icon me-2 text-white">
                                    <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                                </svg>Create new product</a>
                        </li>
                    @endcan
                </ul>
            </div>
            <div class="row" style="margin-left:5px; margin-top:7px;">

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <input type="text" id="product_name_search" class="form-control"  oninput="get_auto_suggestion_product()" placeholder="please type product name">
                    <select class="form-control" name="medicine_name" id="product_name_select">

                    </select>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3">
                    <input type="text" id="generic_name_search" class="form-control"  oninput="get_auto_suggestion_generic()" placeholder="please type generic name">
                    <select class="form-control" name="generic_name" id="generic_name_select">

                    </select>
                </div>

                <div class="col-xs-2 col-sm-2 col-md-2">
                    <button onclick="myFunction(); return false;" style="height:30px; font-weight:bold; margin-top:42px; background-color:#f4f6f9; border:1px solid #4B92f9;">Search</button>
                </div>
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

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="ppp">
                        <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Product Category</th>
                            <th>Product Group</th>
                            <th>Product Name</th>
                            <th>Generic Name</th>
                            <th>Strength</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
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

        myFunction = function() {
            var table = $('#ppp').DataTable();
            table.ajax.reload();
        }
        var table = $('#ppp').DataTable({
            processing: true,
            serverSide: false,
            searching: true,
            lengthMenu: [[10, 25, 50,100,250, -1], [10, 25, 50, 100,250, "All"]],
            ajax: {
                url: "{{ route('products.index') }}",
                data: function (d) {
                    d.medicine_name = $('#product_name_select').val();
                    d.generic_name = $('#generic_name_select').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product_category', className: 'align-middle'},
                {data: 'product_group', className: 'align-middle'},
                {data: 'medicine_name', className: 'align-middle'},
                {data: 'generic_name', className: 'align-middle'},
                {data: 'strength', className: 'align-middle'},
                {data: 'action', className: 'text-center align-middle', orderable: false, searchable: false},
            ],
            dom: 'Blfrtip',

            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
            ],
        });

        /*$('#unique-search').onclick(function(e) {
            table.draw();
            e.preventDefault();
        });*/

    </script>


    <script>
        function get_auto_suggestion_product() {
            let product_name = $('#product_name_search').val();
            $.ajax({
                url: "{{route('getAutoSuggestProduct.name')}}",
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


        function get_auto_suggestion_generic()
        {

            let generic_name = $('#generic_name_search').val();

            $.ajax({
                url: "{{route('getAutoSuggestGeneric.name')}}",
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
    </script>
@endsection

