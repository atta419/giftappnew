<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VerificationController extends BassController
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    public function emailVerify(Request $request){
        $validate = Validator::make($request->all(), [
            'token' => 'required'
        ]);
        $user = Auth::user();
        if ($user->is_verify == $request['token']) {
            $user->is_verify = 1;
            $user->markEmailAsVerified();
            $user->save();
            return $this->sendResponse('Email verified');
        }elseif ($user->is_verify == 1) {
            return $this->sendError('Your email is already verified');
        }else {
            return $this->sendError('Wrong token');
        }
    }
}
