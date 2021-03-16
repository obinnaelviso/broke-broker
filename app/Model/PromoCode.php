<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ServiceStat;
use App\Model\PcType;

class PromoCode extends Model
{
    protected $dates = ['expire_at'];

    protected $casts = [
        'expire_at' => 'datetime',
    ];

    public function service_stat() {
    	return $this->belongsTo(ServiceStat::class);
    }

    public function pc_type() {
    	return $this->belongsTo(PcType::class);
    }
}
