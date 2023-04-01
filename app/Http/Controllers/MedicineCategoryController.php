<?php

namespace App\Http\Controllers;

use App\MedicineCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class MedicineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicineCategories = MedicineCategory::orderBy('id','desc')->get();
        return view('medicineCategories.index',compact('medicineCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicineCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $medicineCategory = MedicineCategory::create($input);
    
        return redirect()->route('medicineCategories.index')
                        ->with('success','Medicine Category  created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineCategory  $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicineCategory = MedicineCategory::find($id);
        return view('medicineCategories.show',compact('medicineCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineCategory  $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineCategory $medicineCategory)
    {
        return view('medicineCategories.edit',compact('medicineCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineCategory  $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicineCategory $medicineCategory)
    {
        $medicineCategory->update($request->all());
        return redirect()->route('medicineCategories.index')
                        ->with('success','Medicine Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineCategory  $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineCategory $medicineCategory)
    {
        $medicineCategory->delete();  
        return redirect()->route('medicineCategories.index')
                        ->with('success','Medicine Category deleted successfully');
    }


}
