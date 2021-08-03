<?php

namespace App\Http\Controllers\Auth;

// Models
use App\Models\User;

// Laravel
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller {
    /*
        Index page
    */
    public function index() {
        return view("auth.register");
    }

    /*
        When the user submits the registration form
    */
    public function store(Request $request) {
        // Validation
        $this->validate($request, [
            "g-recaptcha-response" => ["required", "captcha"],
            "email" => ["required", "email", "max:100", "unique:users,email"],
            "username" => ["required", "max:20", "unique:users,username"],
            "password" => ["required", "confirmed"]
        ]);

        // Create User
        $newUser = User::create([
            "email" => $request->get("email"),
            "username" => $request->get("username"),
            "password" => Hash::make($request->get("password"))
        ]);

        // Register event
        event(new Registered($newUser));

        // Redirect User
        return redirect()->route("auth.login");
    }
}
