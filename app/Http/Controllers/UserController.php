<?php

namespace App\Http\Controllers;

// Models
use App\Models\User;
use App\Models\Game;
use App\Models\Follow;
use App\Models\StrategyGuide;

// Rules
use App\Rules\MatchOldPassword;
use App\Rules\MatchOldEmail;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    /*
        The profile page of a user
    */
    public function profile(User $user) {
        return view("user.profile")->with("user", $user);
    }

    /*
        The account page of the user
    */
    public function account() {
        return view("user.account")->with("user", Auth::user());
    }

    /*
        A form was submitted on the account page of the user
    */
    public function update(Request $request) {
        // Get which form was submitted (if any were)
        if ($request->has("changepassword")) {
            /*
                The change password form was submitted
            */

            // Validate
            $this->validate($request, [
                "password" => ["required", new MatchOldPassword],
                "new_password" => ["required", "confirmed"]
            ]);

            // Change the password
            Auth::user()->update(["password" => Hash::make($request->get("new_password"))]);

        } else if ($request->has("changeemail")) {
            /*
                The change email form was submitted
            */

            // Validate
            $this->validate($request, [
                "new_email" => ["required", "email", "max:100", "unique:users,email"]
            ]);

            // Change the email
            Auth::user()->update(["email" => $request->get("new_email")]);

        }

        return view("user.account")->with("user", Auth::user());
    }
}
