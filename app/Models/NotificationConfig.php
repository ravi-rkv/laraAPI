<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotificationConfig extends Model
{
    use HasFactory;

    public function getNotifyDataByEventCode(string $eventCode)
    {
        $data = DB::table('notification_configs as nc')
            ->join('notification_associates as na', 'nc.id', '=', 'na.notify_id')
            ->select('nc.event_code', 'na.notify_on', 'na.op1', 'na.op2', 'na.content', 'na.id as notify_assoc_id', 'na.notify_id')
            ->where('nc.event_code', '=', $eventCode)
            ->get();
        if ($data) {
            return collect($data)->map(function ($x) {return (array) $x;})->toArray();
        }
    }

    public function checkPreviousMessageByCode($user_id, $event_code, $otp, $identifire = null)
    {

        $data = DB::table('notification_configs as nc')
            ->join('notification_logs as nl', 'nc.id', '=', 'nl.notify_id')
            ->select('nl.created_at', 'nl.notify_id')
            ->where(['nl.is_valid' => 1, 'nc.is_active' => 1, 'nc.event_code' => $event_code, 'nl.user_id' => $user_id, 'nl.identifier' => $otp]);
        if ($identifire) {
            $data->where(['nl.extra_identifier' => $identifire]);
        }
        return $data->first();
    }

}
