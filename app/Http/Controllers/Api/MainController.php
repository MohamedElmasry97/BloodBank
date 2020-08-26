<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Post;
use App\Models\Client;
use App\Models\Government;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Token;
use App\Models\Donate;
use App\Models\Blood_Type;
use App\Models\Config;
use App\Models\Setting;

class MainController extends Controller
{
    public function governorates()
    {
        $governorates = Government::all();
        return JsonResponse(1, 'success', $governorates);
    }

    public function cities(Request $request)
    {
        $cities = City::where(function ($query) use ($request) {
            if ($request->has('government_id')) {
                $query->where('government_id', $request->government_id);
            }
        })->get();
        return JsonResponse(1, 'success', $cities);
    }

    public function posts(Request $request)
    {
        $posts = Post::where(function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            } else {
                $query->with('category');
            }
        })->get();
        return JsonResponse(1, 'success', $posts);
    }

    public function postOne(Request $request)
    {
        $post = Post::where('id', $request->id)->get();

        return JsonResponse(1, 'success', $post);
    }

    public function ToggleFavourite(Request $request, $id)
    {
        //   $client = Client::where('api_token', $request->api_token)->first();
        $client = $request->user(); // middleware auth:api
        // auth : api - clients
        //$client = auth()->guard('api')->user();  // Auth::user()
        //$client = auth('api')->user();
        $request->user()->post_favourite()->toggle($request->id);

        return JsonResponse(1, 'sccussfull');
    }

    public function ListFavourite(Request $request)
    {
        $client = $request->user();

        $favourite = $client->post_favourite()->where('client_id', $client->id)->get();

        return JsonResponse(1, 'successfully list favourite', $favourite);
    }

    public function notificationSetting(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'government_id' => 'required|array',
            'government_id.*' => 'exists:governments,id',
            'blood_type_id' => 'required|array',
            'blood_type_id.*' => 'exists:blood_types,id',
            'action' => 'required|in:get,set',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        if ($request->action == 'set') {
            $request->user()->governments()->sync($request->government_id);
            $request->user()->bloodtypes()->sync($request->blood_type_id);
        }

        return JsonResponse(1, 'successfully', [
            $request->user()->governments()->pluck('governments.id')->toArray(),
            $request->user()->bloodtypes()->pluck('blood_types.id')->toArray(),
        ]);
    }

    public function dontationRequestCreate(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'age' => 'required:digits',
            'blood_type_id' => 'required|exists:blood_types,id',
            'no_bags' => 'required:digits',
            'hospital_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $dontationRequest = $request->user()->requests()->create($request->all());

        $clientsIds = $dontationRequest->city->government->clients()->whereHas('bloodtypes', function ($q) use ($request) {
            $q->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();
dd($clientsIds);
        if (count($clientsIds)) {
            $notification = $dontationRequest->notifications()->create([
                'title' => 'احتاج متبرع لفصيلة ',
                'content' => $dontationRequest->blood_type . 'محتاج متبرع لفصيلة',
            ]);

            $notification->clients()->attach($clientsIds);

            $tokens = Token::whereIn('client_id', $clientsIds)->where('token', '!=', null)->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'donation_id' => $dontationRequest->id,
                ];
                $send = notifyByFirebase($title, $content, $tokens, $data);
            }
            return JsonResponse(1, 'successfull', $send);
        } else {
            JsonResponse(1, 'not user found');
        }
    }

    public function listDonations(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'government_id' => 'exists:governments,id',
            'blood_type_id' => 'exists:blood_types,id',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }
        //if ($request->has('government_id') || $request->has('blood_type_id')) {
        // code...
        $donations = Donate::wherehas('city', function ($q) use ($request) {
            $q->where('government_id', $request->government_id);
        })->paginate(20);

        return  JsonResponse(1, 'success', $donations);
    }

    public function donationRead(Request $request)
    {
        $unread = count($request->user()->notifications()->where('is_read', false)->get());
        if ($unread > 0) {
            return JsonResponse(1, 'unread notifications', $unread);
        } else {
            return JsonResponse(0, 'all readed');
        }
    }

    public function donateOne(Request $request, $id)
    {
        $donate = $request->user()->requests()->where('id', $request->id)->get();
        // $donate = Donate::where('id',$request->id)->first();
        return JsonResponse(1, 'donate exists', $donate);
    }

    public function editClient(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'min:3|max:50',
            'email' => 'email|unique:clients,email',
            'password' => 'confirmed|min:6|max:20',
            'phone' => 'unique:clients,phone|numeric',
            'city_id' => 'exists:cities,id',
            'blood_type_id' => 'exists:blood_types,id',
            'donation_last_date' => 'date',
        ]);
        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::where('api_token', $request->api_token)->first()->update($request->all());

        return JsonResponse(1, 'successfull Edit', $client) ;
    }

    public function settings(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'client_phone' => 'required:digits',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $contact = Setting::create($request->all());

        return JsonResponse(1, 'successfully', $contact);
    }

    public function config()
    {
        $config = Config::all();
        return JsonResponse(1, 'successfully', $config);
    }
}
