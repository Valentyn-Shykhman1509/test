<?php

namespace App\Services;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Resources\CompanyResource;

class CompanyService
{
	public function createCompany(Request $request) {
		$user = Auth::user();
		$user->companies()->create([
		    'name' => $request->name,
			'phone' => $request->phone,
			'description' => $request->description
		]);
		
		return response()->json(['status' => 'success']);
	}
	
	public function getCompanies(Request $request) {
		$quantity = $request->get('quantity', 10);
		$offset = $request->get('offset', 0);
		
		return response()->json(['status' => 'success', 'data' => CompanyResource::collection(Auth::user()->companies()->skip($offset)->take($quantity)->get())]);
	}

	
}