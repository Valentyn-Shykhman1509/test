<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PasswordReset extends Model
{
	protected $fillable = [
        'token', 'user_id', 'valid_to'
    ];
	
	public function user() {
		return $this->belongsTo(User::class);
	}
}