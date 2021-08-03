<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller {
    /*
        Log out the user
    */
    public function store() {
        auth()->logout();

        return redirect()->route("index");
    }
}
