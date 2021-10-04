<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\User;
use App\PasswordReset;
use App\Http\Resources\AuthResource;

class AuthService
{
	public function createUser(Request $request) {
		$data = $request->only(['first_name', 'last_name', 'phone', 'email']);
		$data['api_key'] = base64_encode($this->generateRandomString(70));
		$data['password'] = Hash::make($request->input('password'));
		$user = User::create($data);
		
		return response()->json(['status' => 'success', 'data' => new AuthResource($user)]);
	}
	
	public function signIn(Request $request) {
		try {
			$user = User::where('email', $request->input('email'))->first();
		    throw_unless($user, new \Exception('Wrong credentials', 401));
		    throw_unless(Hash::check($request->input('password'), $user->password), new \Exception('Wrong credentials', 401));
			$user->update(['api_key' => base64_encode($this->generateRandomString(70))]);
		
		    return response()->json(['status' => 'success', 'data' => new AuthResource($user)]);
			
		} catch(\Exception $e) {
			return response()->json([
			    'status' => 'fail',
			    'message' => $e->getMessage()
			], $e->getCode());
		}
	}
	
	public function createResetToken(Request $request) {
		try {
			$user = User::where('email', $request->email)->first();
		    throw_unless($user, new \Exception('User not found', 404));
			$line = $user->resetTokens()->create([
			    'token' => $this->generateRandomString(50),
				'valid_to' => Carbon::now()->addDay()->format('Y-m-d')
			]);
			
			Mail::send('auth.emails.password', ['token' => $line->token], function($message) use($user) {
                $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Password reset!');
            });	
			
			return response()->json(['status' => 'success']);
		} catch(\Exception $e) {
			return response()->json([
			    'status' => 'fail',
			    'message' => $e->getMessage()
			], $e->getCode());
		}
		
	}
	
	public function updatePassword(Request $request) {
		try {
			$token = PasswordReset::where('token', '=', $request->token)
			    ->where('valid_to', '>', Carbon::now()->format('Y-m-d'))->first();
			throw_unless($token, new \Exception('Token not valid', 401));
			throw_if($token->user->email !== $request->email, new \Exception('Token not valid', 401));
			$token->user->update(['password' => Hash::make($request->password)]);
			
			return response()->json(['status' => 'success']);
		} catch(\Exception $e) {
			return response()->json([
			    'status' => 'fail',
			    'data' => ['message' => $e->getMessage()]
			], $e->getCode());
		}
	}
	
	protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
		
        return $randomString;
    }
	
}