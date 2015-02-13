<?php namespace App\Http\Controllers;

use App\Http\Requests;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['only' => ['update', 'settings']]);
    }



}
