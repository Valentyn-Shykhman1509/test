<?php

namespace App\Traits\Validators;

trait CreateCompanyValidator
{
	public function validateCompany($request) {
		$this->validate($request, [
		    'name' => 'required|min:2|max:255',
			'phone' => 'required|min:7|max:50',
        ]);
	}
}