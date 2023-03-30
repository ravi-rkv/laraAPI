<?php
namespace App\Services;

date_default_timezone_set('Asia/Kolkata');

use App\Models\NotificationConfig;
use App\Models\NotificationEmailSmsConfig;
use App\Models\NotificationLog;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;

class NotificationService
{

    private $notify;
    private $notifyLog;
    private $notifyConfig;
    public function __construct()
    {
        $this->notify = new NotificationConfig();
        $this->notifyLog = new NotificationLog();
        $this->notifyConfig = new NotificationEmailSmsConfig();
    }

    public function sendOTP($requestData)
    {
        // dd($requestData);
        $userdata = $requestData['userdata'];
        $event = @$requestData['event'];
        $mobile = @$requestData['mobile'];
        $email = @$requestData['email'];
        $eventcode = @$requestData['eventcode'];

        if ($userdata['twofa_status'] = 1) {
            $otpConfigDetail = $this->notify->getNotifyDataByEventCode($requestData['event_code']);

            if ($otpConfigDetail) {
                $newOtpValue = mt_rand(100000, 999999);

                foreach ($otpConfigDetail as $key => $value) {
                    if ($value['notify_on'] == 'SMS' || $value['notify_on'] == 'EMAIL') {
                        $sent_on = ($value['notify_on'] == "SMS") ? $mobile : $email;

                        $checkPreviousOtpSentOn = $this->notifyLog->checkPreviousNotification([
                            "user_id" => $userdata['user_id'],
                            "sent_on" => $sent_on,
                            'notify_assoc_id' => $value['notify_assoc_id'],
                            'is_valid' => 1,
                            "extra_identifier" => isset($requestData['otp_ref']) ? trim($requestData['otp_ref']) : null,
                        ]);

                        $insertNewLog = true;
                        if ($checkPreviousOtpSentOn) {
                            $lastNotifSentOn = strtotime($checkPreviousOtpSentOn['datetime']);
                            $resendAllowedUpto = strtotime("+ 10 minutes", $lastNotifSentOn);
                            $resendSameContent = (($resendAllowedUpto - time()) > 0) ? true : false;

                            if ($resendSameContent) {
                                $insertNewLog = false;
                                $otpValue = trim($checkPreviousOtpSentOn['identifier']); //otpval value changed.
                            } else {
                                $otpValue = $newOtpValue;
                                $expire_validity = $this->notifyLog->checkNotificationValidity($checkPreviousOtpSentOn['id']);
                                $insertNewLog = true;
                            }

                        } else {
                            // trigger new sms and email
                            $otpValue = $newOtpValue;
                            $insertNewLog = true;
                        }
                        $value['content'] = str_replace('$USER$', $userdata['first_name'], $value['content']);
                        $value['content'] = str_replace('$OTP$', $otpValue, $value['content']);
                        if ($insertNewLog === true) {
                            $log_array = array(
                                "notify_id" => $value['notify_id'],
                                "notify_assoc_id" => $value['notify_assoc_id'],
                                "user_id" => $userdata['user_id'],
                                "sent_on" => $sent_on,
                                "identifier" => $otpValue,
                                "content" => $value['content'],
                                "created_at" => Carbon::now(),
                                "extra_identifier" => isset($requestData['otp_ref']) ? trim($requestData['otp_ref']) : null,
                                "is_valid" => 1,
                            );

                            $insertNewOtpLog = NotificationLog::insert($log_array);
                        }

                        $this->processNotification($value, $requestData);
                    }

                }

            }

        }

    }

    private function processNotification($notifyData, $requestData)
    {
        if ($notifyData['notify_on'] == "SMS" || $notifyData['notify_on'] == "EMAIL") {
            $notifyConfig = $this->notifyConfig->getNotificationConfigs($notifyData['notify_on']);
            if ($notifyConfig) {

                if ($notifyConfig['config_type'] == "SMS") {

                    // $requestid ='123456';
                    // $url = $notifyConfig['param1'];
                    // $url = str_replace('$MOBILE$', $requestData['mobile'], $url);
                    // $url = str_replace('$REQUESTID$', $requestid, $url);
                    // $url = str_replace('$CONTENT$', urlencode($notifyData['content']), $url);

                    // $insert_logarray = array(

                    //     "request" => $url,
                    //     "request_dt" => date('Y-m-d H:i:s'),
                    //     "request_id" => $requestid,
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
                    //             "response" => $response,
                    //             "response_dt" => date('Y-m-d H:i:s'),
                    //             "smslogid" => $sms_logdata,
                    //         );
                    //     } else {
                    //         $update_logarray = array(
                    //             "response" => "No Response",
                    //             "response_dt" => date('Y-m-d H:i:s'),
                    //             "smslogid" => $sms_logdata,
                    //         );
                    //     }

                    //     $this->_ci->alert_md->update_sms_log($update_logarray);
                    // }
                } else {

                    $mail = new PHPMailer(true);

                    $mail->SMTPDebug = 0; //Enable verbose debug output
                    $mail->isSMTP(); //Send using SMTP
                    $mail->Host = $notifyConfig['param2']; //Set the SMTP server to send through
                    $mail->SMTPAuth = true; //Enable SMTP authentication
                    $mail->Username = $notifyConfig['param3']; //SMTP username
                    $mail->Password = $notifyConfig['param4']; //SMTP password
                    $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
                    $mail->Port = $notifyConfig['param5']; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->SetFrom($notifyConfig['param1'], 'DivInfo Tech');
                    $mail->AddAddress($requestData['email']); //Add a recipient

                    //Content
                    $mail->isHTML(true); //Set email format to HTML
                    $mail->Subject = $notifyData['op1'];
                    $mail->Body = $notifyData['content'];

                    $mail->send();

                }
            }
        }
    }

}
