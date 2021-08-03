<?php

namespace App\Http\Controllers\Auth;

// Laravel
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller {
    /**
     * The main page that displays the login form
     * 
     * @return Illuminate\View\View
     */
    public function index() {
        return view("auth.login");
    }

    /**
     * When the login form is submitted, log the user in if the credentials are correct
     * 
     * @return mixed
     */
    public function store(Request $request) {
        // Validate
        $this->validate($request, [
            "email" => ["required", "email"],
            "password" => ["required"],
            "remember_me" => ["nullable"]
        ]);

        // Get remember (if true then this user stays logged indefinetly until logged out)
        $remember = $request->has("remember_me") ? true : false;

        // Authentication
        if (Auth::attempt(["email" => $request->get("email"), "password" => $request->get("password")], $remember)) {

            // Authentication is successful
            // Redirect the user to the last page they were on
            return redirect()->route("index");

        } else {

            // Autenticantion fails and send an error to the view
            $error = ValidationException::withMessages([
                "invalidcredentials" => ["The email or password is incorrect."]
            ]);
            throw $error;

        }
    }
}
