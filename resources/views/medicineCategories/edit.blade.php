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
               
                <form  action="{{ route('medicineCategories.update',$medicineCategory->id) }}"  method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="updated_by" value="{{ Auth::user()->name }}">

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Category Name:</strong>
                         <input type="text" name="category_name" class="form-control" value="{{ $medicineCategory->category_name }}" placeholder="category name">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <strong>Description:</strong>
                          <input type="text" name="description" class="form-control" value="{{ $medicineCategory->description }}" placeholder="description">
                        </div>
                    </div>

                </div> 

                                    
                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <strong>Status:</strong>
                          <select name="status" class="form-control">
                              <option value="{{ $medicineCategory->status }}">{{ $medicineCategory->status }}</option>
                              <option value="Active">Active</option>
                              <option value="In Active">In Active</option>
                           </select>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <strong>Remarks:</strong>
                          <input type="text" name="remarks" class="form-control"  value="{{ $medicineCategory->remarks }}" placeholder="remarks"/> 
                        </div>
                    </div>

                </div>

            
                </br>
                <div class="row">	
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                      @can('product-category-edit')
                      <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to save?')">Submit</button>
                      @endcan
                    </div>
                </div>


                </form>

            </div>


            
        </div>
    </div>
@endsection

