<?php

namespace App\Traits\Validators;

trait SendEmailValidator
{
	public function validateEmail($request) {
		$this->validate($request, [
            'email' => 'required|email'
        ]);
	}
}