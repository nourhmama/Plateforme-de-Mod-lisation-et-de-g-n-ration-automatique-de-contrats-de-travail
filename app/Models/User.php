<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'company',
        'phone_number',
        'role',
        'verified' // Ajoutez la colonne vérifiée
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->verified = 'Non vérifié'; // Définit la valeur par défaut pour la colonne 'verified'
        });
    }


    public function sendPasswordResetNotification($token)
{
    $url = 'http://localhost:5173/auth/reset-password?token=' . $token;
    $this->notify(new ResetPasswordNotification($url));
}
public function sendAccountVerifiedNotificationn($token)
{
    $url = 'http://localhost:5173/auth/login';
    $this->notify(new AccountVerifiedNotification($url));
}




}
