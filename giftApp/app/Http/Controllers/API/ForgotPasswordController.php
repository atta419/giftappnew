<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class ForgotPasswordController extends BassController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //send case success
    public function forgotPassword(Request $request, $response)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validate->fails()) {
            return $this->sendError('Validate error', $validate->errors());
        }
        $email = $request['email'];
        if (User::where('email', $email)->doesntExist()) {
            return $this->sendError('Email is not exist check it');
        }
        // Generate the forgot code
        $token = Str::random(5);
        try {
            if (DB::table('password_resets')->where('email', $email)->first()) {
                DB::table('password_resets')->where('email', $email)->update([
                    'token' => $token,
                ]);
                Mail::send('email.forgot', ['token' => $token], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Reset your password');
                    $message->priority(1);
                });
                return $this->sendResponse('Check your email');
            }
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);
            //Send the code to the email
            Mail::send('Mails.forgot', ['token' => $token], function ($message) use ($email){
                $message->to($email);
                $message->subject('Reset your password');
                $message->priority(1);
            });
            return $this->SendResponse('check your email', 200);
        } catch (\Throwable $th) {
            return $this->sendError('Something went wrong', $th->getMessage());
        }
    }

    public function resendCode(Request $request, $response)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        $email = $request['email'];
        $token = Str::random(4);
        DB::table('password_resets')->where('email', $request['email'])->update([
            'token' => $token,

        ]);
        $email = $request['email'];
        Mail::send('Mails.forgot', ['token' => $token], function ($message) use ($email){
            $message->to($email);
            $message->subject('Reset your password');
            $message->priority(1);
        });
        return $this->SendResponse('check your email', 200);
    }

    public function passwordReset(Requets $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->SendError('Validate Error', $validator->errors());
        }
        if (User::where('email', $request['email'])->doesntExist()) {
            $this->SendError('Invalid Email', 404);
        }
        if (!DB::table('password_resets')->where('email', $request['email'])->first()) {
            return $this->SendError('Invalid email', 404);
        }
        if (!DB::table('password_resets')->where('token', $request['token'])->first()) {
            return $this->SendError('Invalid token', 404);
        }
        $user = User::where('email', $request['email'])->first();
        $user->password = Hash::make($request['password']);
        DB::table('password_resets')->where('email', $request['email'])->where('token', $request['token'])->delete();
        $user->save();
        return $this->SendResponse('User password changed successfully', 200);
    }
}
