<?php

namespace App\Http\Controllers\Auth;

// Laravel
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller {
    /**
     * A page containing a notice for the user to confirm their email
     */
    public function emailNotice() {
        // Display
        return view("auth.verifyemail"); 
    }

    /**
     * Verfies the user's email and then redirects them
     */
    public function verifyEmail(EmailVerificationRequest $request) {
        // Verify Email
        $request->fulfill();
        
        // Redirect
        return redirect()->route("index");
    }
}
