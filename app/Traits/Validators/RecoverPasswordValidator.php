<?php

namespace App\Traits\Validators;

trait RecoverPasswordValidator
{
	public function validatePasswordRecovery($request) {
		$this->validate($request, [
            'email' => 'required|email',
			'token' => 'required',
            'password' => 'required',
			'password_confirmation' => 'required|same:password'
        ]);
	}
}