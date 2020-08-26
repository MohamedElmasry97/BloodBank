<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetAdminPasswordController extends Controller
{

    public function index()
    {
        $records = User::paginate(5);
        return view('reset_password.index', compact('records'));
    }
    public function update(Request $request)
    {
        validator($request->all() , [
            'email' => 'required | exists:users,email',

            'password' => 'required'| 'string'| 'min:8'| 'confirmed'
        ]);



        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

            return redirect()->back();
    }
}
