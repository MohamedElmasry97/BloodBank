<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('filter');
        if ($search != null) {
            $records = Setting::where('name', 'LIKE', '%' . $request->filter . '%')->orWhere('email', 'LIKE', '%' . $request->filter . '%')->get();

        }else {
            $records = Setting::paginate(20);
        }

        return view('contact.index', compact('records'));
    }

    public function destroy($id)
    {
        Setting::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
