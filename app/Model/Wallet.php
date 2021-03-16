<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ServiceStat;

class Wallet extends Model
{
    public function service_stat() {
    	return $this->belongsTo(ServiceStat::class);
    }
}
