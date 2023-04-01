@extends('layouts.app')

@section('content')
    <div class="container-fluid pl-0 px-0">
        <div class="card mb-3">

            <div class="card-header">
                <nav aria-label="breadcrumb" role="navigation">
                    <div class="col-12">
                        <span style="text-align:left; font-family:arial;font-weight:bold;color:blue;">Product Category Edit</span>                     
                    </div>
                </nav>
            </div>


            <div class="card-body">
               
                <form  action="{{ route('miscExpenditures.update',$miscExpenditure->id) }}"  method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Expense Amount:</strong>
                         <input type="text" name="expense_amount" class="form-control"  value="{{ $miscExpenditure->expense_amount }}"  placeholder="expense amount">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" class="form-control" value="{{ $miscExpenditure->description }}" placeholder="description">                       
                        </div>
                    </div>

                </div> 

                      
                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <strong>Start Date:</strong>
                          <input type="date" name="start_date" class="form-control"  value="{{ $miscExpenditure->start_date }}" placeholder="start date"/> 
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <strong>End Date:</strong>
                          <input type="date" name="end_date" class="form-control"  value="{{ $miscExpenditure->end_date }}" placeholder="end date"/> 
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Base Name:</strong>
                        <select class="form-control" name="base_name" id="base_name">
                            <option value="{{ Auth::user()->base_name }}">{{ Auth::user()->base_name }}</option>
                            <option value="Air HQ (U)">Air HQ (U)</option>
                            <option value="BAF BSR">BAF BSR</option>
                            <option value="BAF BBD">BAF BBD</option>
                            <option value="BAF MTR">BAF MTR</option>
                            <option value="BAF ZHR">BAF ZHR</option>
                            <option value="BAF PKP">BAF PKP</option>
                            <option value="BAF CXB">BAF CXB</option>
                        </select>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <strong>Remarks:</strong>
                          <input type="text" name="remarks" class="form-control"  value="{{ $miscExpenditure->remarks }}" placeholder="remarks"/> 
                        </div>
                    </div>
                </div>

                                    
                </br>
                <div class="row">	
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      @can('miscExpenditure-edit')
                      <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save?')">Submit</button>
                      @endcan
                    </div>
                </div>


                </form>

            </div>


            
        </div>
    </div>
@endsection

