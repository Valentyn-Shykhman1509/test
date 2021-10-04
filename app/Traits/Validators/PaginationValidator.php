<?php

namespace App\Traits\Validators;

trait PaginationValidator
{
	public function validatePagination($request) {
		$this->validate($request, [
		    'quantity' => 'integer',
			'offset' => 'integer',
        ]);
	}
}