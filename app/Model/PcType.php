<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\PromoCode;
use App\Model\ServiceStat;
use App\Model\User;

class PcType extends Model
{
	
    protected $casts = [
        'expire_at' => 'datetime',
    ];
    protected $dates = ['expire_at'];

    public function promo_codes() {
    	return $this->hasMany(PromoCode::class);
    }

    public function service_stat() {
    	return $this->belongsTo(ServiceStat::class);
    }

    public function admin() {
    	return $this->belongsTo(Admin::class);
    }
}
