<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|max:10',
        ]);

        if ($validator->fails()) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = $validator->errors()->first();
            $data['data'] = [];

            return response()->json($data, 400);
        }

        $data = $this->loginService->login($request->only(['email', 'password']));
        return response()->json($data);
    }

    public function verifyLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'otp' => 'required|digits:6',
            'referenceId' => 'required|digits:18',
        ]);

        if ($validator->fails()) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = $validator->errors()->first();
            $data['data'] = [];
            return response()->json($data, 400);
        }

        $data = $this->loginService->verifyLoginOtp($request->only(['email', 'otp', 'referenceId']));
        return response()->json($data);
    }

    public function userProfile()
    {
        if (!auth()->user()) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Login Required';
            $data['data'] = [];
        } else {
            $data['resp_code'] = 'RCS';
            $data['resp_desc'] = 'Request Completed Successfully';
            $data['data'] = auth()->user();
        }
        return response()->json($data);
    }
}
