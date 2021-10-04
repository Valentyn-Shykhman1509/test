<?php

namespace App\Traits\Validators;

trait LoginValidator
{
	public function validateLogin($request) {
		$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
	}
}