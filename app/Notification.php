<?php

namespace NotiConnect;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'uuid',
        'package_name',
        'title',
        'text',
        'sub_text',
        'group'
    ];

    public function user()
    {
        return $this->belongsTo('NotiConnect\Models\Relational\User');
    }

    public function icon()
    {
        return $this->belongsTo('NotiConnect\Models\Relational\Icon');
    }
}
