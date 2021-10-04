<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Validators\SignUpValidator;
use App\Traits\Validators\LoginValidator;
use App\Traits\Validators\SendEmailValidator;
use App\Traits\Validators\RecoverPasswordValidator;
use App\Services\AuthService;

class AuthController extends Controller
{
	use SignUpValidator, LoginValidator, SendEmailValidator, RecoverPasswordValidator;
	
	private $authService;
	
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }
	
	public function signIn(Request $request) {
		$this->validateLogin($request);
		
		return $this->authService->signIn($request);
	}

    public function signUp(Request $request) {
		$this->validateSignUp($request);
		
		return  $this->authService->createUser($request);
	}
	
	public function sendToken(Request $request) {
		$this->validateEmail($request);
		
		return $this->authService->createResetToken($request);
	}
	
	public function updatePassword(Request $request) {
		$this->validateEmail($request);
		
		return $this->authService->updatePassword($request);
		
	}
}