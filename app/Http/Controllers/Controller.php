<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function RedirectIfNotOwner($id) {
		if ($id == Auth::id()) {
			return true;
		}

		return abort(403, '没有权限');
	}

}
