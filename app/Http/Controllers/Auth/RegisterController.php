<?php

namespace App\Http\Controllers\Auth;

use App\Depot;
use App\Employee;
use App\DepotUser;
use App\Designation;
use App\Department;
use App\OfficeLocation;
use App\Region;
use App\DistributorUser;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Register Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles the registration of new users as well as their
		    | validation and creation. By default this controller uses a trait to
		    | provide this functionality without requiring any additional code.
		    |
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	//protected $redirectTo = '/users';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(); //for load logo
		$this->middleware('auth');

		$this->middleware(function ($request, $next) {
			$roles = Role::pluck('name', 'id');
			view()->share('roles', $roles);

			$designations = Designation::pluck('title', 'id');
			view()->share('designations', $designations);
			$departments = Department::pluck('name', 'id');
			view()->share('departments', $departments);
			$officelocations = OfficeLocation::pluck('name', 'id');
			view()->share('officelocations', $officelocations);
			$regions = Region::pluck('name', 'id');
			view()->share('regions', $regions);
			$depots = Depot::pluck('name', 'id');
			view()->share('depots', $depots);
			

			return $next($request);
		});
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		//dd($data);
		return Validator::make($data, [
			'name' => 'required',
			'department_id' => 'required',
			'role_id' => 'required',
			'designation_id' => 'required',
			'office_loc_id' => 'required',
			'region_id' => 'required',
			'depot_id' => 'required',
			'username' => 'required|string|max:255|unique:users',
			'email' => 'required|string|email|max:255|unique:users',
			'mobile' => 'required|string|size:11|nullable|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data) {
		//dd($data);
		return User::create([
			'name' => $data['name'],
			'role_id' => $data['role_id'],
			'designation_id' => $data['designation_id'],
			'department_id' => $data['department_id'],
			'office_loc_id' => $data['office_loc_id'],
			'region_id' => $data['region_id'],
			'depot_id' => $data['depot_id'],
			'mobile' => $data['mobile'],
			'username' => $data['username'],
			'email' => $data['email'],
			'status' => $data['status'],
			'password' => bcrypt($data['password']),
		]);

		
	}

	public function register(Request $request) {
		$this->validator($request->all())->validate();
		//dd($request);
		event(new Registered($user = $this->create($request->all())));

		$this->guard()->login($user);
		//dd($user);
		return $this->registered($request, $user)
		?: redirect($this->redirectPath());
	}

	public function showUserLists() {
		$users = User::with([
			'role' => function ($q) {
				$q->select('id', 'name');
			},
			'designation' => function ($q) {
				$q->select('id', 'title');
			},
			
		])
			->orderBy('id')
			->get();

		
		return view('auth.show_user_lists', compact('users'));
	}

	public function showUser() {

		$user = User::with([
			'designation' => function ($q) {
				return $q->select('id', 'title', 'short_name');
			},
			'role' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->findOrFail(auth()->id());
		return view('auth.user_profile', compact('user'));
	}
	public function editUser($id) {
		$user = User::findOrFail($id);
		//dd($user);
		return view('auth.edit_user', compact('user'));
	}

	public function updateUser(Request $request, $id) {
		$data = $request->except('_method', '_token', 'depots');
		$request->validate([
			'role_id' => 'required',
			'designation_id' => 'required',
			'email' => 'required|string|email|max:255|unique:users,email,' . $id,
			'mobile' => 'required|string|max:11|nullable|unique:users,mobile,' . $id,
		]);
		//User::find($id) for update event fire on user model
		$user = User::find($id)->update($data);
		if ($user) {
			$message = "You have successfully updated";
			return redirect()->route('users.edit', $id)
				->with('flash_success', $message);

		}
	}

	public function destroyUser($id) {
		$user = User::findOrFail($id);
		$query = $user->delete();
		//dd($users);
		if ($query) {
			//Storage::delete('images/avatar/' . $user->avatar);
			$message = "You have successfully deleted";
			return redirect()->route('users.index')
				->with('flash_success', $message);
		} else {
			$message = "Data could not be deleted";
			return redirect()->route('users.index')
				->with('flash_error', $message);
		}
	}

	public function changePassword(Request $request) {
		//$method = $request->method();
		//dump($method);
		if ($request->isMethod('put')) {
			$this->validate(request(), [
				'current_password' => 'required|current_password',
				'new_password' => 'required|string|min:6|confirmed',
			]);
			$query = $request->user()->fill([
				'password' => Hash::make($request->input('new_password')),
			])->save();
			if ($query) {
				$message = "You have successfully changed your password";
				return redirect()->route('password.change')
					->with('flash_success', $message);
			} else {
				$message = "Password could not be changed! Please try again.";
				return redirect()->route('password.change')
					->with('flash_error', $message);
			}
		} else {
			return view('auth.passwords.change');
		}

	}
	public function changeUserPassword(Request $request, $id) {
		if ($request->isMethod('put')) {
			$this->validate(request(), [
				'new_password' => 'required|string|min:6|confirmed',
			]);
			$user = User::find($id);
			$query = $user->fill([
				'password' => Hash::make($request->input('new_password')),
			])->save();
			if ($query) {
				$message = "You have successfully changed password";
				return redirect()->route('password.changeUserPassword', $id)
					->with('flash_success', $message);
			} else {
				$message = "Password could not be changed! Please try again.";
				return redirect()->route('password.changeUserPassword', $id)
					->with('flash_error', $message);
			}
		} else {
			return view('auth.passwords.change_user_password', compact('id'));
		}

	}
	public function download() {
		return (new UserExport())->download('users.xlsx');
	}
}
