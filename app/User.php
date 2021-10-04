<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use App\Company;
use App\PasswordReset;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'password', 'email', 'api_key', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
		'api_key'
    ];
	
	public function getTokenAttribute() {
		return $this->api_key;
	}
	
	public function companies() {
		return $this->hasMany(Company::class);
	}
	
	public function resetTokens() {
		return $this->hasMany(PasswordReset::class);
	}
}
