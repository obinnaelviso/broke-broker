<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    const PENDING = 0;
    const CANCELLED = -1;
    const COMPLETED = 1;

    protected $casts = [
        'expire_at' => 'datetime',
    ];

    protected $dates = ['expire_at'];

    protected $guarded = [];

    public function plan() {
        return $this->belongsTo(InvestmentPlan::class, 'investment_plan_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
