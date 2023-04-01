@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">
            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12 text-end">
                        <a class="btn btn-success text-white" href="{{ route('roles.index') }}">Role List</a>
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <form action="{{route('roles.update', $role->id)}}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row mb-3">
                                <label  for="name">Role<span class="text-danger">*</span> </label>
                                <div class=" input-group">
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text" value="{{$role->name}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class=" input-group">
                                    <div class="form-check form-check-inline" style="width: 14rem;">
                                        <input class="form-check-input" name="all-permission" id="all-permission" onclick="checkPage(this)" type="checkbox">
                                        <label  for="name">Permissions <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class=" input-group">
                                    @foreach($permission as $value)
                                        <div class="form-check form-check-inline" style="width: 14rem;">
                                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-check-input')) }}
                                            <label class="form-check-label" for="spontaneous"><small>{{ $value->name }}</small></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 text-end">
                                    @can('role-edit')
                                    <button class="btn btn-success text-white" type="submit">Submit</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

