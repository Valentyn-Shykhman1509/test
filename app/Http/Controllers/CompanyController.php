<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Validators\CreateCompanyValidator;
use App\Traits\Validators\PaginationValidator;
use App\Services\CompanyService;
use Auth;

class CompanyController extends Controller
{
	use CreateCompanyValidator, PaginationValidator;
	
	private $companyService;
	
    public function __construct(CompanyService $companyService) {
		$this->middleware('auth');
        $this->companyService = $companyService;		
    }
	
	public function addCompany(Request $request) {
		$this->validateCompany($request);
		
		return $this->companyService->createCompany($request);
	}
	
	public function getCompanies(Request $request) {
		$this->validatePagination($request);
		
		return $this->companyService->getCompanies($request);
	}
	
}