<?php

namespace App\Services;

date_default_timezone_set('Asia/Kolkata');

use Carbon\Carbon;
use App\Models\NotificationLog;
use App\Models\NotificationConfig;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;

class NotificationService
{

    public function sendOTP($requestData)
    {
        $userData = $requestData['userData'];
        $successCount = 0;

        if ($userData->twofa_status === 1) {
            $notificationConfig = NotificationConfig::where('event_code', $requestData['event_code'])
                ->with('notificationAssociates', function ($query) {
                    $query->select([
                        'notify_on as notifyOn',
                        'op1 as option1',
                        'op2 as option2',
                        'content',
                        'id as notifyAssocId',
                        'notify_id'
                    ])->with('associateSenderConfig');
                })->select([
                    'id',
                    'event_code as eventCode'
                ])->get();

            //if notification is empty
            if (!$notificationConfig) {
                return false;
            }

            //if notification associates has nothing
            $notificationAssociates = $notificationConfig->first()->notificationAssociates;
            if ($notificationAssociates->isEmpty()) {
                return false;
            }

            if (array_diff($notificationAssociates->pluck('notifyOn')->toArray(), ['SMS', 'EMAIL'])) {
                return false;
            }

            $newOtpValue = mt_rand(100000, 999999);
            foreach ($notificationAssociates as $notificationAssociate) {
                //if notification has no sender config 
                if (!$notificationAssociate->associateSenderConfig) {
                    continue;
                }

                $sentOn = ($notificationAssociate->notify_on === 'SMS') ? $requestData['mobile'] : $requestData['email'];

                $previousOtpLog = NotificationLog::where([
                    'user_id' => $userData['user_id'],
                    'sent_on' => $sentOn,
                    'notify_assoc_id' => $notificationAssociate->notifyAssocId,
                    'is_valid' => 1,
                    'extra_identifier' => isset($requestData['otp_ref']) ? trim($requestData['otp_ref']) : null,
                    // 'extra_identifier' => '010437285371342023',
                ])->first();

                $insertNewLog = true;
                if ($previousOtpLog) {
                    // $lastNotificationSentTime = Carbon::parse($previousOtpLog->created_at);
                    $lastNotificationAllowedTime = Carbon::parse($previousOtpLog->created_at)->addMinutes(10);

                    //if allowed time is greater than current time then send previous otp
                    if ($lastNotificationAllowedTime->greaterThan(Carbon::now())) {
                        $insertNewLog = false;
                        $newOtpValue = $previousOtpLog->identifier;
                    } else {
                        //expire the previous Otp Log 
                        $previousOtpLog->is_active = 0;
                        $previousOtpLog->update();
                    }
                }

                //set variable replacement in content
                $notificationAssociate->content = str_replace('$USER$', $userData['first_name'], $notificationAssociate->content);
                $notificationAssociate->content = str_replace('$OTP$', $newOtpValue, $notificationAssociate->content);

                if ($insertNewLog) {
                    $isInserted = NotificationLog::insert([
                        'notify_id' => $notificationAssociate->notify_id,
                        'notify_assoc_id' => $notificationAssociate->notifyAssocId,
                        'user_id' => $userData['user_id'],
                        'sent_on' => $sentOn,
                        'identifier' => $newOtpValue,
                        'content' => $notificationAssociate->content,
                        'created_at' => Carbon::now(),
                        'extra_identifier' => isset($requestData['otp_ref']) ? trim($requestData['otp_ref']) : null,
                        'is_valid' => 1,
                    ]);
                } else {
                    // say you have exceeded the otp limit please try after XXXX time 
                }

                //actual notification fired
                $successCount += $this->processNotification($notificationAssociate, $userData);
            }
        }

        return $successCount; //true if more than 0
    }

    private function processNotification($notificationAssociate, $user)
    {
        $senderConfig = $notificationAssociate->associateSenderConfig;
        if ($senderConfig->config_type === 'SMS') {
            return false;

            // $requestid ='123456';
            // $url = $senderConfig->param1;
            // $url = str_replace('$MOBILE$', $requestData['mobile'], $url);
            // $url = str_replace('$REQUESTID$', $requestid, $url);
            // $url = str_replace('$CONTENT$', urlencode($notifyData['content']), $url);

            // $insert_logarray = array(

            //     'request' => $url,
            //     'request_dt' => date('Y-m-d H:i:s'),
            //     'request_id' => $requestid,
            // );

            // // $sms_logdata = $this->_ci->alert_md->log_sms_content($insert_logarray);
            // if ($sms_logdata) {

            //     $curl = curl_init();
            //     curl_setopt_array($curl, array(
            //         CURLOPT_URL => $url,
            //         CURLOPT_RETURNTRANSFER => true,
            //         CURLOPT_ENCODING => '',
            //         CURLOPT_MAXREDIRS => 10,
            //         CURLOPT_TIMEOUT => 0,
            //         CURLOPT_CUSTOMREQUEST => 'GET',
            //     ));

            //     $response = curl_exec($curl);

            //     curl_close($curl);

            //     if ($response) {
            //         $update_logarray = array(
            //             'response' => $response,
            //             'response_dt' => date('Y-m-d H:i:s'),
            //             'smslogid' => $sms_logdata,
            //         );
            //     } else {
            //         $update_logarray = array(
            //             'response' => 'No Response',
            //             'response_dt' => date('Y-m-d H:i:s'),
            //             'smslogid' => $sms_logdata,
            //         );
            //     }

            //     $this->_ci->alert_md->update_sms_log($update_logarray);
            // }
        } else {
            return true;
            try {
                $mail = new PHPMailer(true);

                $mail->SMTPDebug = 0; //Enable verbose debug output
                $mail->isSMTP(); //Send using SMTP
                $mail->Host = $senderConfig->param2; //Set the SMTP server to send through
                $mail->SMTPAuth = true; //Enable SMTP authentication
                $mail->Username = $senderConfig->param3; //SMTP username
                $mail->Password = $senderConfig->param4; //SMTP password
                $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
                $mail->Port = $senderConfig->param5; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->SetFrom($senderConfig->param1, 'DivInfo Tech');
                $mail->AddAddress($user->email); //Add a recipient

                //Content
                $mail->isHTML(true); //Set email format to HTML
                $mail->Subject = $notificationAssociate->option1;
                $mail->Body = $notificationAssociate->content;

                $mail->send();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
}
