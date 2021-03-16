<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Model\Wallet;
use App\Model\Transaction;
use App\Model\TransferStat;
use App\Model\ReferenceNo;
use App\Model\WithdrawRequest;
use App\Model\AccStat;
use App\Model\AssignedPc;

class User extends Authenticatable
// class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','gender', 'phone', 'country', 'address', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assigned_pcs() {
        return $this->hasMany(AssignedPc::class);
    }

    public function otp() {
        return $this->hasOne('App\Model\Otp')->latest();
    }

    public function otps() {
        return $this->hasMany('App\Model\Otp');
    }

    public function wallet() {
        return $this->hasOne(Wallet::class);
    }

    public function transactions() {
        return $this->hasMany(MyTransaction::class);
    }

    public function acc_stat() {
        return $this->belongsTo(AccStat::class);
    }

    public function withdraw_requests() {
        return $this->hasMany(WithdrawRequest::class);
    }

    public function transfer_stats() {
        return $this->hasMany(TransferStat::class);
    }

    public function reference_nos() {
        return $this->hasMany(ReferenceNo::class);
    }

    public function password_check($password) {
        return Hash::check($password, $this->attributes['password']);
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function investments() {
        return $this->hasMany(Investment::class);
    }
}
