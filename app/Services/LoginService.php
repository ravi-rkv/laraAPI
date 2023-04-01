<?php

namespace App\Services;

use App\Models\ApiTokenLog;
use App\Models\NotificationConfig;
use App\Models\NotificationLog;
use App\Models\User;
use App\Services\JwtTokenService;
use App\Services\NotificationService;

class LoginService
{
    public function login(array $request)
    {
        $userData = User::where('email', $request['email'])
            ->where('password', md5($request['password']))
            ->first();

        if (!$userData) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Invalid Login Details';

            return $data;
        }

        if (!is_array(allowedAccountStatusForLogin()) || empty(allowedAccountStatusForLogin())) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Validation Error';

            return $data;
        }

        if (!in_array($userData->status, allowedAccountStatusForLogin())) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Unable to login into your account, current status is ' . ucfirst(strtolower($userData->status));
            return $data;
        }

        if ($userData->twofa_status === 1) {
            $data = $this->sendOTP($userData, [
                'event' => 'Login',
                'event_code' => 'LGNOTP',
            ]);
        } else {
            $token = new JwtTokenService();
            $data = $token->generateAuthToken($userData, $request);
        }

        return $data;
    }

    public function verifyLoginOtp($request)
    {

        $validLogin = User::where('email', $request['email'])->first();

        if (!$validLogin) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Invalid Login Details';
            return $data;
        }

        $userData = $validLogin->toArray();

        $allowedStatus = allowedAccountStatusForLogin();
        if (!is_array($allowedStatus) || empty($allowedStatus)) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Validation Error';
            return $data;
        }
        if (!in_array($userData['status'], $allowedStatus)) {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Unable to login into your account, current status is ' . ucfirst(strtolower($userData['status']));
            return $data;
        }

        if ($userData['twofa_status'] == 1) {

            $checkIfTokenExist = ApiTokenLog::where(['user_id' => $userData['user_id'], 'is_active' => '1'])->first();
            if ($checkIfTokenExist) {
                $data['resp_code'] = 'ERR';
                $data['resp_desc'] = 'User Already Logged In';
            }
            $noti = new NotificationConfig();
            $validOtp = $noti->checkPreviousMessageByCode($userData['user_id'], 'LGNOTP', $request['otp'], $request['referenceId']);

            if ($validOtp) {
                $otpValidFrom = strtotime($validOtp->created_at);
                $otpValidUpto = strtotime('+10 minutes', $otpValidFrom);
                $isValidOtp = (($otpValidUpto - time()) > 0) ? true : false;
                if ($isValidOtp) {

                    $expiredOtp = NotificationLog::where(['user_id' => $userData['user_id'], 'notify_id' => $validOtp->notify_id])->update(['is_valid' => '0']);
                    if ($expiredOtp) {

                        $token = new JwtTokenService();
                        $data = $token->generateAuthToken($userData, $request);
                    } else {
                        $data['resp_code'] = 'ERR';
                        $data['resp_desc'] = 'Internal Error Occoured';
                    }
                } else {
                    $data['resp_code'] = 'ERR';
                    $data['resp_desc'] = 'OTP Expired';
                }
            } else {
                $data['resp_code'] = 'ERR';
                $data['resp_desc'] = 'Invalid OTP';
            }
        } else {
            $data['resp_code'] = 'ERR';
            $data['resp_desc'] = 'Invalid Request';
            $data['data'] = [];
        }

        return $data;
    }

    private function sendOTP($userData, $requestArray)
    {
        $requestArray['userData'] = $userData;
        $requestArray['mobile'] = $userData['mobile'];
        $requestArray['email'] = $userData['email'];
        $requestArray['host'] = @$_SERVER['SERVER_NAME'];
        $requestArray['otp_ref'] = isset($requestArray['otp_ref']) ? $requestArray['otp_ref'] : date('Hmi') . rand(100001, 999999) . date('sY');

        $notify = new NotificationService();
        // $notify->sendOTP($requestArray);
        $sendOtpResponse = $notify->sendOTP($requestArray);

        $data['resp_code'] = 'ERR';
        $data['resp_desc'] = 'Something Went Wrong';
        $data['data'] = [];

        if ($sendOtpResponse) {
            $data['resp_code'] = 'TFA';
            $data['resp_desc'] = 'OTP Sent Succcessfully';
            $data['data'] = ['referenceId' => $requestArray['otp_ref']];
        }

        return $data;
    }
}
