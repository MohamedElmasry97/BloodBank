<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $records = User::paginate(20);

        return view('Users.index', compact('records'));
    }

    public function create(User $model)
    {
        return view('Users.create', compact('model'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'password' => 'required|confirmed',
            'email' => 'email',
            'roles_list' => 'required'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except('roles_list'));
        $user->roles()->attach($request->input('roles_list'));
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $row = User::FindOrFail($id);
        return view('Users.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,' . $id,
            'password' => 'confirmed',
            'email' => 'email',
            'roles_list' => 'required'
        ]);
        $row = User::FindOrFail($id);

        $row->roles()->sync((array) $request->input('roles_list'));
        $request->merge(['password' => bcrypt($request->password)]);

        $row->update($request->all());

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $record = User::FindOrFail($id);

        if (!$record) {
            return response()->json([
                'status' => 0,
                'message' => 'no role found!!',
            ]);
        } else {
            $record->delete();
            return response()->json([
                'status' => 1,
                'message' => 'deleted successfully',
                'id' => $id
            ]);
        }
    }
}
