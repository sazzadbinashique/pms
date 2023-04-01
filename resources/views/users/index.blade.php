@extends('layouts.app')

@section('title','')

@section('content')
    <div class="container-fluid px-0">
        <div class="card mb-3">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills justify-content-between">
                    <li class="nav-item">User List</li>
                    @can('user-create')
                        <li class="nav-item"><a class="btn btn-success text-white" href="{{route('users.create')}}">
                            <svg class="icon me-2 text-white">
                                <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-plus')}}"></use>
                            </svg>Create New User</a>
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
                    <table class="table table-hover table-bordered" id="user_tbl">
                        <thead class="table-dark">
                        <tr>
                            <th style="width: 5rem;">Ser No</th>
                            <th style="width: 12rem">Name</th>
                            <th style="width: 12rem">Base</th>
                            <th style="width: 12rem">Email</th>
                            <th style="width: 12rem">Mobile</th>
                            <th style="width: 35rem;">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody style="font-weight:bold;">
                        @foreach($users as $key=>$user)
                            @php
                                $bg=($key%2==0?'bg-info-new':'bg-success');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle">{{$user->name}}</td>
                                <td class="align-middle">{{$user->base_name}}</td>
                                <td class="align-middle">{{$user->email}}</td>
                                <td class="align-middle">{{$user->mobile}}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                       <label class="bg-warning text-white">{{ $v }}</label>
                                    @endforeach
                                  @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        @can('user-edit')
                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                        @endcan
                                        
                                        @can('user-delete')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger text-white" type="submit">Delete</button>
                                        </form>
                                        @endcan

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
    
    let url = "{{ route('users.index') }}";
    $('#user_tbl').DataTable( {

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
            $('#user').DataTable();
        } );
    </script>
@endsection

