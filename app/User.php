<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;
    // use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
        'namaLengkap','alamat','nomorKtp','noHp',
        'fotoKtp','confirmed'
    ];

    public function roles()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function owners()
    {
        return $this->Hasmany('App\Models\Konten','id_user','id');
    }
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
    
}
