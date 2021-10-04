<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Company extends Model
{
	protected $fillable = [
        'name', 'phone', 'description'
    ];
	
	public function user() {
		return $this->belongsTo(User::class);
	}
}