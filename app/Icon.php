<?php

namespace NotiConnect;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'notification_icons';

    protected $fillable = ['base64'];

    public function notifications()
    {
        return $this->hasOne('NotiConnect\Notification');
    }
}
