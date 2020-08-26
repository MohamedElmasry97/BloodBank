<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit($id)
    {
        $row = Config::FindOrFail($id)->first();

        return view('config.index' , compact('row'));
    }

    public function update(Request $request , $id)
    {
       $record =  Config::FindOrFail($id)->update($request->all());
        return redirect()->back();
    }
}
