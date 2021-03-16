<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ReferenceNo;
use App\Model\ServiceStat;
use App\Model\User;
class WithdrawRequest extends Model
{
    protected $dates = ['expire_at'];

    public function reference_no() {
    	return $this->belongsTo(ReferenceNo::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function service_stat() {
    	return $this->belongsTo(ServiceStat::class);
    }

    public function scopeSuccess($query) {
        return $query->where('service_stat_id', 3);
    }
    public function scopeFailed($query) {
        return $query->where('service_stat_id', 4);
    }
    public function scopeCancelled($query) {
        return $query->where('service_stat_id', 7);
    }
    public function scopeInProgress($query) {
        return $query->where('service_stat_id', 6);
    }
    public function scopePending($query) {
        return $query->where('service_stat_id', 5);
    }

    public function scopeNewest($query) {
        return $query->orderBy('updated_at','desc');
    }

    public function scopeOldest($query) {
        return $query->orderBy('id');
    }
}
