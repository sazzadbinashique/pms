@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">
            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12 text-left">
                        <span style="color:blue;">Create New User</span>
                    </div>
                </nav>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Name:*</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                       <div class="form-group">
                       <strong>Base:*<span style="color:#ff0000"></span></strong>
                       <select class="form-control" name="base_name" id="base_name" required="true">
						<option>Select One</option>
                        <option value="Air HQ (U)">Air HQ (U)</option>
						<option value="BAF BSR">BAF BSR</option>
						<option value="BAF BBD">BAF BBD</option>
						<option value="BAF MTR">BAF MTR</option>
						<option value="BAF ZHR">BAF ZHR</option>
						<option value="BAF PKP">BAF PKP</option>
						<option value="BAF CXB">BAF CXB</option>
                        <option value="MINUSCA(CAR)">MINUSCA(CAR)</option>
						<option value="MINUSMA(MALI)">MINUSMA(MALI)</option>
						<option value="MONUSCO(CONGO)">MONUSCO(CONGO)</option>
				       </select>      
                      </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Email:*</strong>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <strong>Mobile:</strong>
                        <input type="text" name="mobile" placeholder="Mobile No"  class="form-control" >
                       </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Password:*</strong>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Confirm Password:*</strong>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:*</strong>
                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        @can('user-create')
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @endcan
                    </div>
                </div>
                {!! Form::close() !!}
                    {{-- <div class="row ">
                        <div class="col-12 text-end">
                            <button class="btn btn-success text-white" type="submit">Submit</button>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection

