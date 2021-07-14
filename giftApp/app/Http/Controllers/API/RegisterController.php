<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BassController as BassController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Laravel\Passport\HasApiTokens;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends BassController
{
    //for register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:5048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Your information is not correct', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($request['password']);
        $user = User::create($input);
        if ($request->has('photo')) {
            $newImageName = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move('uploads/ProfilePics', $newImageName);
            $imgaeURL = url('/uploads/ProfilePics'.'/'.$newImageName);
            DB::table('users')->where('email', $request['email'])->update([
                'profile_photo_path' => $imgaeURL,
            ]);
        }
        $token = Str::random(5);
        try {
            DB::table('users')->where('email', $request['email'])->update([
                'is_verify' => $token,
            ]);
            $email = $request['email'];
            Mail::send('email.verify', ['token' => $token], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Verify your email');
            });
        } catch (\Throwable $th) {
            return $this->sendError('Something went wrong', $th->getMessage());
        }
        $userData = User::where('email', $request['email'])->first();
        $success['name'] = $userData->name;
        $success['photo'] = $userData->profile_photo_path;
        $success['token'] = $userData->createToken('gift')->accessToken;

        return $this->sendResponse($success, 'You registered successfully');
    }

    public function login(Request $request){
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = Auth::user();
            if (Auth::user()->is_verify != 1) {
                return $this->sendError('Please verify your email');
            }
            $success['name'] = $user->name;
            $success['photo'] = $user->profile_photo_path;
            $success['token'] = $user->createToken('gift')->accessToken;
            return $this->SendResponse($success, 'logged in successfully');
        }
    }
    //for logout
    protected function loggedOut(Request $request)
    {
        Auth::logout();
        return $this->sendResponse('You logged out successfully');
    }
}
