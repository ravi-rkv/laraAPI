<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationEmailSmsConfig extends Model
{
    use HasFactory;

    public function getNotificationConfigs($config_type)
    {
        $data = NotificationEmailSmsConfig::where('config_type', $config_type)->first();

        if ($data) {
            return $data->toArray();
        }
    }
}
