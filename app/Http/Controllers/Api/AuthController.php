<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reset_Password;
use App\Models\Token;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|confirmed|min:6|max:20',
            'phone' => 'required|unique:clients,phone|numeric',
            'city_id' => 'required|exists:cities,id',
            'blood_type_id' => 'required|exists:blood_types,id',
            'donation_last_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());

        $client->api_token = str_random(60);

        $client->save();

        return JsonResponse(1, 'sccussfull adding client', [
            'api_token' => $client->api_token,
            'client' => $client,
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => 'required|numeric',
            'password' => 'required|min:6|max:20',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        //return Auth::guard('api')->validate($request->all());
        $client = Client::where('phone', $request->phone)->first();

        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return JsonResponse(1, 'sccussfully login', [
                    'api_token' => $client->api_token,
                    'client' => $client,
                ]);
            } else {
                return JsonResponse(0, 'البيانات التي ادخلتها غير صحيحة ');
            }
        } else {
            return JsonResponse(0, 'البيانات التي ادخلتها غير صحيحة ');
        }
        //    return Auth::guard('api')->attempt([
        //        'phone' => $request->phone,
        //        'password' => $request->password,
        //    ]);
    }

    public function ResetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => 'required|exists:clients,phone',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();

        $code = rand(11111, 99999);
        $update = $client->update(['pin_code' => $code]);
        if ($update) {
            // SMS_Verification($request->phone, 'Your reset Password Code is :' . $code);

          //  Mail::to($client->email)->send(new Reset_Password($code));

            return JsonResponse(1, ' برجاء فحص الهاتف ', ['test_code' => $code]);
        } else {
            return JsonResponse(0, 'خطاء حاول مرة اخرى');
        }
    }

    public function newPasswordSet(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => 'required|exists:clients,phone',
            'password' => 'required|confirmed',
            'pin_code' => 'required',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();
        if ($client->pin_code == $request->pin_code) {
            $request->merge(['password' => bcrypt($request->password)]);
            $update = $client->update([
                'password' => $request->password,
                'pin_code' => $request->NULL,
            ]);
            if ($update) {
                return JsonResponse(1, 'password changed');
            } else {
                return JsonResponse(0, 'password not changed');
            }
        } else {
            return JsonResponse(0, 'pin_code not correct');
        }
    }

    public function registerToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',
            'type' => 'required|in:android,ios',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return JsonResponse(1, 'تم التسجيل بنجاح ');
    }

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',
            'type' => 'required|in:android,ios',
        ]);

        if ($validator->fails()) {
            return JsonResponse(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();
        return JsonResponse(1, 'تم الحذف بنجاح');
    }
}
