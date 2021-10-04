<?php

namespace App\Traits\Validators;

trait SignUpValidator
{
	public function validateSignUp($request) {
		$this->validate($request, [
		    'first_name' => 'required|min:2|max:255',
			'last_name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users',
			'phone' => 'required|min:7|max:50',
            'password' => 'required'
        ]);
	}
}