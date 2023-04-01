<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAssociate extends Model
{
    use HasFactory;

    public function associateSenderConfig()
    {
        return $this->hasOne(NotificationEmailSmsConfig::class, 'config_type', 'notifyOn');
    }
}
