<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'user_id', 'code', 'service_stat_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function service_stat() {
    	return $this->belongsTo(ServiceStat::class);
    }
}
