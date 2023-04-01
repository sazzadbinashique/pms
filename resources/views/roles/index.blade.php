@extends('layouts.app')

@section('title','')

@section('content')
    <div class="container-fluid px-0">
        <div class="card mb-3">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills justify-content-between">
                    <li class="nav-item" style="color:black; font-weight:bold;">Role List</li>
                    @can('role-create')
                    <li class="nav-item"><a class="btn btn-success text-white" href="{{route('roles.create')}}">
                            <svg class="icon me-2 text-white">
                                <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                            </svg>Create New Role</a>
                    </li>
                    @endcan
                </ul>
            </div>
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
                    <table class="table table-hover table-bordered" id="role_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th style="width: 5rem;">Ser No</th>
                            <th style="width: 12rem">Role</th>
                            <th style="width: 35rem;">Permission Area</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key=>$role)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle" style="font-weight:bold;">{{$role->name}}</td>
                                <td>
                                    @foreach($role->permissions as $per)
                                        <span class="bg-secondary text-black" style="font-size:18px; font-weight:bold;">{{ $per->name }}</span></br>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">

                                        @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        @endcan

                                        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            @can('role-delete')
                                            <button class="btn btn-danger text-white" type="submit">Delete</button>
                                            @endcan
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--{{ $roles->links('vendor.pagination.custom') }}--}}
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
    
    let url = "{{ route('roles.index') }}";
    $('#role_tbl').DataTable( {

            //dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'pageLength': 10
        } );


    </script>
@endsection


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

