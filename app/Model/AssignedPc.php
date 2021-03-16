<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\PromoCode;
use App\Model\User;
use App\Model\ServiceStat;

class AssignedPc extends Model
{
	public function user() {
 		return $this->belongsTo(User::class);
 	}   

 	public function promo_code() {
 		return $this->belongsTo(PromoCode::class);
 	}   

 	public function service_stat() {
 		return $this->belongsTo(ServiceStat::class);
 	}
}
