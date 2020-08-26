<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('filter');
        if ($search != null) {
            $records = Donate::where('name', 'LIKE', '%' . $request->filter . '%')->orWhere('hospital_name', 'LIKE', '%' . $request->filter . '%')->get();

        }else {
            $records = Donate::paginate(20);
        }
        return view('Donations.index', compact('records'));
    }

    public function edit($id)
    {
        $model = Donate::FindOrFail($id);
        return view('Donations.edit' , compact('model'));
    }

    public function update(Request $request , $id)
    {
        Donate::FindOrFail($id)->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        Donate::FindOrFail($id)->delete();
        return redirect()->back();

    }
}
