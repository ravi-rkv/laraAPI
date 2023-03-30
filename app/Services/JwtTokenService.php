<?php
namespace App\Services;

use App\Models\ApiTokenLog;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class JwtTokenService
{

    public function generateAuthToken(array $userData, array $params)
    {
        $key = md5('APIKEY');

        if (count($userData) > 0 && count($params) > 0) {
            $payload = [];
            $payload['user_id'] = $userData['user_id'];
            $payload['role_id'] = $userData['role_id'];
            $payload['email'] = $userData['email'];
            $payload['logged_at'] = date('Y-m-d H:i:s');
            $output = JWT::encode($payload, $key, 'HS256');

            $insert_array = [
                'user_id' => $userData['user_id'],
                'request_id' => Str::random(10),
                'token_id' => $output,
                'created_at' => $payload['logged_at'],
                'ip' => Request::ip(),
                'useragent' => Request::userAgent(),
                'is_active' => 1,
            ];
            $insertLog = ApiTokenLog::insert($insert_array);
            if ($insertLog) {
                $data['resp_code'] = "RCS";
                $data['resp_desc'] = "Request Completed Successfully";
                $data['data'] = [
                    'token' => md5($output),
                    'request_id' => $insert_array['request_id'],
                    'user_data' => [
                        'user_id' => $userData['user_id'],
                        'username' => $userData['first_name'] . ' ' . $userData['last_name'],
                        'mobile' => $userData['mobile'],
                        'email' => $userData['email'],
                        'dob' => $userData['dob'],
                        'role_id' => $userData['role_id'],
                        'avatar' => $userData['profile_pic'],
                        'loggedin_at' => $payload['logged_at'],
                    ],
                ];

            } else {
                $data['resp_code'] = "ERR";
                $data['resp_desc'] = "Internal Processing Error";
            }
        } else {
            $data['resp_code'] = "ERR";
            $data['resp_desc'] = "Internal Processing Error";
        }

        return $data;
    }
}
