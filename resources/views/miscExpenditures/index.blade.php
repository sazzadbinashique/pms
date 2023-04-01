@extends('layouts.app')

@section('title','')

@section('content')

    <div class="container-fluid px-0">
        <div class="card mb-3">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills justify-content-between">
                    <li class="nav-item" style="font-family:arial;font-weight:bold;">Misc Expenditure List</li>
                    @can('miscExpenditure-create')
                        <li class="nav-item"><a class="btn btn-success text-white btn-sm" href="{{route('miscExpenditures.create')}}">
                            <svg class="icon me-2 text-white">
                                <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                            </svg>Create new Misc Expense</a>
                        </li>
                    @endcan

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

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="misc_expense_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th>Ser No</th>
                            <th>Expense Amount</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Base Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($miscExpenditures as $key=>$data)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle">{{$data->expense_amount}} Tk</td>
                                <td class="align-middle">{{$data->description}}</td>
                                <td class="align-middle">{{$data->start_date}}</td>    
                                <td class="align-middle">{{$data->end_date}}</td>   
                                <td class="align-middle">{{$data->base_name}}</td>                      
                                <td class="text-center align-middle">
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <a class="btn btn-info text-white btn-sm" href="{{ route('miscExpenditures.show',$data->id) }}">Details</a>

                                        @can('miscExpenditure-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('miscExpenditures.edit',$data->id) }}">Edit</a>
                                        @endcan

                                        @can('miscExpenditure-delete')
                                        <form action="{{ route('miscExpenditures.destroy', $data->id) }}" method="post">
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
    
    let url = "{{ route('miscExpenditures.index') }}";
    $('#misc_expense_tbl').DataTable( {

            //dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'pageLength': 10
        } );


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

