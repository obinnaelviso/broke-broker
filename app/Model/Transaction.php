<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Transaction;
use App\Model\ServiceStat;
use App\Model\ReferenceNo;
use App\Model\User;

class Transaction extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function trans_type() {
    	return $this->belongsTo(TransType::class);
    }

    public function service_stat() {
    	return $this->belongsTo(ServiceStat::class);
    }

    public function reference_no() {
        return $this->belongsTo(ReferenceNo::class);
    }

    public function scopeFilterCredit($query) {
        return $query->where('trans_type_id', 1);
    }

    public function scopeFilterDebit($query) {
        return $query->where('trans_type_id', 2);
    }

    public function scopeFilterTransfer($query) {
        return $query->where('trans_type_id', 3);
    }

    public function scopeFilterWithdraw($query) {
        return $query->where('trans_type_id', 4);
    }

    public function scopeSortNewest($query) {
        return $query->orderBy('id','desc');
    }

    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    public function scopeSortSuccess($query) {
        return $query->orderBy('service_stat_id');
    }

    public function scopeSortFailed($query) {
        return $query->orderBy('service_stat_id', 'desc');
    }
}
