<?php

namespace App;

use App\Notifications\alterarSenha;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerificarEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.         
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'senha',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerificarEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new alterarSenha($token));
    }

    protected function setUserPassword($user, $password)
    {
        $user->senha = Hash::make($password);
    }
}
