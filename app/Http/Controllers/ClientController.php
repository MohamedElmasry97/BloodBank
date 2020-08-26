<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('filter');
        if ($search != null) {
            $records = Client::where('name', 'LIKE', '%' . $request->filter . '%')->orWhere('email', 'LIKE', '%' . $request->filter . '%')->get();
        } else {
            $records = Client::paginate(20);
        }

        return view('client.index', compact('records'));
    }

    public function destroy($id)
    {
        Client::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
