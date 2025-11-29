<?php

namespace App\Http\Controllers;


use App\Models\Location;
use App\Models\Designation;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use App\Models\CustomerComplain;
use App\Models\CustomerComplainLog;
use App\Models\CustomerComplainType;
use App\Models\ComplainCategory;
use App\Models\ComplainSubcategory;
use App\Traits\HasStageExists;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller {
	use HasStageExists;
	private $canApply = false;
	private $user = null;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->middleware(function ($request, $next) {
			if ($request->user()) {
				$this->user = $request->user();
				$this->canApply = (bool) Role::where('id', $this->user->role_id)->value('can_apply');
			}
			return $next($request);
		});
		//$this->middleware('auth');
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		//------------------Test Zashidul----------------------

		$comlainTypes = CustomerComplainType::pluck('name','id');
		$comlainCategories = ComplainCategory::pluck('name','id');
		$comlainSubCategories = ComplainSubcategory::pluck('name','id');
        //dd($comlainSubCategories->toArray());
        //dd($comlainSubCategories->id);
        $employees = User::where('id',auth()->user()->id)
        ->get();
        //dd($employees->toArray());
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        //dd($divisions);
        //$districtss = Location::with(['id' => function ($q)->pluck('name', 'id');
        //dd($divisions->toArray());
        return view('customerComplains.create', compact('comlainTypes','employees', 'divisions', 'products', 'comlainCategories','comlainSubCategories'));
        //return view('customerComplains.create');
	}

	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

	public function example(Request $request) {
		$request->validate([
			'name' => 'required|min:3|max:255',
		]);
		return collect($request->all());
	}

	// should be deleted after development
	public function pages($name = 'ui-elements_panels') {
		return view('pages.' . $name);
	}
	
		
}