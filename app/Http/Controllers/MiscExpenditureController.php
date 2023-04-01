<?php

namespace App\Http\Controllers;

use App\MiscExpenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class MiscExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miscExpenditures = MiscExpenditure::orderBy('id','desc')->get();
        return view('miscExpenditures.index',compact('miscExpenditures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('miscExpenditures.create');
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
        $miscExpenditures = MiscExpenditure::create($input);

        return redirect()->route('miscExpenditures.index')
                        ->with('success','Misc Expenditure  created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MiscExpenditure  $miscExpenditure
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $miscExpenditure = MiscExpenditure::find($id);
        return view('miscExpenditures.show',compact('miscExpenditure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MiscExpenditure  $miscExpenditure
     * @return \Illuminate\Http\Response
     */
    public function edit(MiscExpenditure $miscExpenditure)
    {
        return view('miscExpenditures.edit',compact('miscExpenditure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MiscExpenditure  $miscExpenditure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MiscExpenditure $miscExpenditure)
    {
        $miscExpenditure->update($request->all());
        return redirect()->route('miscExpenditures.index')
                        ->with('success','Misc Expenditure updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MiscExpenditure  $miscExpenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy(MiscExpenditure $miscExpenditure)
    {
        $miscExpenditure->delete();  
        return redirect()->route('miscExpenditures.index')
                        ->with('success','Misc Expenditure deleted successfully');
    }

}
