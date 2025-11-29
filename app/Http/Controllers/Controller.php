<?php

namespace App\Http\Controllers;
use App\Models\RolePermission;
use App\Models\SiteSetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $menu_list, $site_settings;

	public function __construct() {
	}

	public function checkUses($id, $fieldName, $usesModel) {
		$message = 'This data is already used by another.';
		if (is_array($usesModel)) {
			foreach ($usesModel as $val) {
				$namespace = 'App\\' . $val;
				if ($namespace::where($fieldName, $id)->exists()) {
					return redirect()->back()->with('flash_danger', $message);
				}
			}
			return 'no';
		} else {
			$namespace = 'App\\' . $usesModel;
			if ($namespace::where($fieldName, $id)->exists()) {
				return redirect()->back()->with('flash_danger', $message);
			} else {
				return 'no';
			}
		}

	}
}
