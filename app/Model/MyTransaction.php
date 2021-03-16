<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MyTransaction extends Model
{
    protected $fillable = [
        'prev_bal', 'amount', 'reference_no', 'description','created_at','user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
