@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">
            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12 text-left">
                      New Role Create
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row mb-3">
                                <label  for="name" style="font-weight:bold;" >Role Name : <span class="text-danger">*</span></label>
                                <div class=" input-group">
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text" placeholder="Role Name" value="{{old('name')}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row mb-3" style="font-weight:bold;">
                                <label  for="name">Permission Name : <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    @foreach($permission as $value)
                                        <div class="form-check form-check-inline" style="width: 14rem;">
                                            <input class="form-check-input " name="permission[]" id="name" type="checkbox" value="{{$value->id}}">
                                            <label class="form-check-label" for="topic"><small>{{ $value->name }}</small></label>
                                        </div>
                                    @endforeach
                                    @error('permission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                    </div>
                    <div class="row ">
                        <div class="col-12 text-end">
                            @can('role-create')
                            <button class="btn btn-success text-white" type="submit">Submit</button>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

