<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::paginate(10);
        return view('roles.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission_list' => 'required | array',
        ], [
            'name.required' => 'Name is required',
            'permission_list.required' => 'permission_list  is required'
        ]);

        $record = Role::create($request->all());
        $record->permissions()->attach($request->permission_list);
        return redirect()->route('role.index');
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
    public function edit($id)
    {
        $model = Role::FindOrFail($id);
        return view('roles.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission_list' => 'required | array',
        ], [
            'name.required' => 'Name is required',
            'permission_list.required' => 'permission_list  is required'
        ]);


       $record = Role::FindOrFail($id);
       $record->update($request->all());
        $record->permissions()->sync($request->permission_list);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $record =  Role::Find($id);

       if (!$record) {
        return response()->json([
            'status' => 0,
            'message' => 'no role found!!',
        ]);
    }else{
        $record->delete();
        return response()->json([
            'status' => 1,
            'message' => 'deleted successfully',
            'id'      => $id
        ]);

    }

    }
}
