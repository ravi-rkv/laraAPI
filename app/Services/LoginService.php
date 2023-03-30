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

    public function verifyLogin($request)
    {

        $validLogin = User::where('email', $request['email'])->where('password', md5($request['password']))->first();

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
            $data = $this->sendOTP($userData, ["event" => "Login", "event_code" => "LGNOTP"]);
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
                $otpValidUpto = strtotime("+10 minutes", $otpValidFrom);
                $isValidOtp = (($otpValidUpto - time()) > 0) ? true : false;
                if ($isValidOtp) {

                    $expiredOtp = NotificationLog::where(['user_id' => $userData['user_id'], 'notify_id' => $validOtp->notify_id])->update(['is_valid' => '0']);
                    if ($expiredOtp) {

                        $token = new JwtTokenService();
                        $data = $token->generateAuthToken($userData, $request);

                    } else {
                        $data['resp_code'] = "ERR";
                        $data['resp_desc'] = "Internal Error Occoured";
                    }
                } else {
                    $data['resp_code'] = "ERR";
                    $data['resp_desc'] = "OTP Expired";
                }
            } else {
                $data['resp_code'] = "ERR";
                $data['resp_desc'] = "Invalid OTP";
            }
        } else {
            $data['resp_code'] = "ERR";
            $data['resp_desc'] = "Invalid Request";
            $data['data'] = [];
        }

        return $data;
    }

    private function sendOTP($user_data, $request_array)
    {
        $user_data = is_array($user_data) ? $user_data : array();
        if (count($user_data) > 0) {
            $request_array['userdata'] = $user_data;
            $request_array['mobile'] = $user_data['mobile'];
            $request_array['email'] = $user_data['email'];
            $request_array['host'] = @$_SERVER['SERVER_NAME'];
            $request_array['otp_ref'] = isset($request_array['otp_ref']) ? $request_array['otp_ref'] : date('Hmi') . rand(100001, 999999) . date('sY');

            $notify = new NotificationService();
            $notify->sendOTP($request_array);

            $data['resp_code'] = "TFA";
            $data['resp_desc'] = "OTP Sent Succcessfully";
            $data['data'] = ["referenceId" => $request_array['otp_ref']];

        } else {
            $data['resp_code'] = "ERR";
            $data['resp_desc'] = "Internal Processing Error";
        }
        return $data;
    }

}
