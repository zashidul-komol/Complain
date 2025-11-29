<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use DB;
use Event;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		include __DIR__ . '/../Http/Macros.php';

		// current password validation rule
		Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
			return Hash::check($value, Auth::user()->password);
		});

	    if (env('APP_ENV') === 'local') {
	        DB::connection()->enableQueryLog();        
	    }

		// Register snake_case helper if it doesn't exist
		if (!function_exists('snake_case')) {
			function snake_case($value, $delimiter = '_')
			{
				return Str::snake($value, $delimiter);
			}
		}
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
