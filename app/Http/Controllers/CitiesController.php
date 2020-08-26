<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($governId)
    {
        $records = City::where('government_id' , $governId)->get();
        return view('cities.index', compact(  'governId' , 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($governId)
    {
        return view('cities.create' , compact('governId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($governId , Request $request)
    {
        $this->validate($request , [
            'name' => 'required',
            $governId => 'exsits:governoments,id'
        ]);
        City::create($request->all() + ['government_id' => $governId]);
        return redirect()->route('governorate.city.index' , $governId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $governId , $id)
    {
        $model = City::FindOrFail($id);
        return view('cities.edit' , compact('model' , 'governId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $governId , $id )
    {
         City::FindOrFail($id)->update($request->all());

        return redirect()->route('governorate.city.index' , compact('governId'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($governId , $id)
    {
        City::FindOrFail($id)->delete();
        return redirect()->route('governorate.city.index' , compact('governId'));
    }
}
