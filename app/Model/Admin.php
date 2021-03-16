<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Model\WithdrawRequest;
use Illuminate\Support\Facades\Hash;
use App\Model\AccStat;
use App\Model\PcType;
use App\Model\AdminMailing;
use App\Notifications\ResetPasswordANotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','gender', 'phone', 'state', 'address', 'email', 'password',
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

    public function withdraw_requests() {
        return $this->hasMany(WithdrawRequest::class);
    }

    public function admin_mailings() {
        return $this->hasMany(AdminMailing::class);
    }

    public function pc_groups() {
        return $this->hasMany(PcType::class);
    }

    public function acc_stat() {
        return $this->belongsTo(AccStat::class);
    }

    public function password_check($password) {
        return Hash::check($password, $this->attributes['password']);
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordANotification($token));
    }
}
