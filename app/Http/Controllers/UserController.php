<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Notifications\TokenNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get_users()
    {
        $users=User::whereNotNull('email_verified_at')->get();
        foreach($users as $user){
            $user->title=$user->role->name;
        }

        return response()->json($users);
    }

    public function register(RegisterRequest $request)
    {
        $random=random_int(10000000, 99999999);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 1,
            'verification_token' => $random,
            'password' => Hash::make($request->password)
        ]);

        $token_data = [
            'token' => $random,
        ];
        Notification::send($user, new TokenNotification($token_data));


        $response = [
            'success' => true,
            'message' => 'Account registered!',
            'email' => $request->email
        ];

        return response()->json($response);
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $user=Auth::user();
        if($request->delete_image){
            if($user->logo) {
                unlink(public_path() . '/storage/images/profile/' . $user->logo);
                $user->logo=null;
                $user->save();

                $response = [
                    'success' => true,
                    'message' => 'Profile photo removed!',
                    'user' => $user,
                ];
                return response()->json($response);
            }
        }
        if($request->password) {
            if (strlen($request->password) < 8) {
                $response = [
                    'success' => false,
                    'message' => 'Password too short!',
                    'user' => $user,
                ];
                return response()->json($response);
            } else {
                $user->password = Hash::make($request->password);
            }
        }
        if($request->name){
            $user->name=$request->name;
        }
        if($request->file('image')){
            $image=$request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $image = \Intervention\Image\Facades\Image::make($image->getRealPath());
            $image->resize(200, 200);
            if($user->logo) {
                unlink(public_path() . '/storage/images/profile/' . $user->logo);
            }
            $image->save(public_path() . '/storage/images/profile/' . $filenameWithExt);
            $user->logo=$filenameWithExt;
        }
        $user->save();
        $user->date=$user->created_at->format("d. M Y.");

       /* $totalBrightness = 0;
        $im = imagecreatefrompng(public_path() . '/storage/images/profile/' . $filenameWithExt);
        $width = imagesx($im);
        $height = imagesy($im);
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($im, $x, $y);

                $red = ($rgb >> 16) & 0xFF;
                $green = ($rgb >> 8) & 0xFF;
                $blue = $rgb & 0xFF;

                $totalBrightness += (max($red, $green, $blue) + min($red, $green, $blue)) / 2;
            }
        }

        $test= ($totalBrightness / ($width * $height)) / 2.55;
*/

        $response = [
            'success' => true,
            'message' => 'Profile updated!',
            'user' => $user,
            //'test' => $test
        ];

        return response()->json($response);
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

            if (Auth::attempt($credentials)) {
                $success = true;
                $message = 'Logged in!';
                $not_verified=false;
                $user=Auth::user();
                    if($user->email_verified_at) {
                        $user->date = $user->created_at->format("d. M Y.");
                        $user->title = $user->role->name;
                        $user->unreadNotifications->sortByDesc('created_at');
                    }
                    else{
                        $success = false;
                        $message = 'Email not verified!';
                        $not_verified=true;

                        $random=random_int(10000000, 99999999);
                        $user=Auth::user();
                        $user->verification_token=$random;
                        $user->save();
                        $token_data = [
                            'token' => $random,
                        ];
                        Notification::send($user, new TokenNotification($token_data));

                        $user = null;
                    }
            }
            else {
                $success = false;
                $message = 'Wrong credentials!';
                $not_verified=false;
                $user=null;
            }

        $response = [
            'success' => $success,
            'message' => $message,
            'user' => $user,
            'not_verified' => $not_verified
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Logged out!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function verify_email($token, $email){
        $user=User::where('email', $email)->first();
        if($user->verification_token===$token){
            $user->email_verified_at=time();
            $user->verification_token=null;
            $user->save();
            $response = [
                'success' => true,
                'message' => 'Email verified!',
            ];
            return response()->json($response);
        }

            $response = [
                'success' => false,
                'message' => 'Incorrect verification code!',
            ];
            return response()->json($response);

    }

    public function request_token($email){
        $user=User::where('email', $email)->first();
        if($user && $user->email_verified_at){
            $random=random_int(10000000, 99999999);
            $user->verification_token=$random;
            $user->save();
            $token_data = [
                'token' => $random,
            ];
            Notification::send($user, new TokenNotification($token_data));

            $response = [
                'success' => true,
                'message' => 'Verification code was sent to your email!',
                'email' => $email
            ];

            return response()->json($response);
        }

            $response = [
                'success' => false,
                'message' => 'Your email is not verified!',
            ];
            return response()->json($response);

    }

    public function reset_password(ResetPasswordRequest $request){
        $user=User::where('email', $request->email)->first();
        if($user && $request->token===$user->verification_token){
            $user->verification_token=null;
            $user->password=Hash::make($request->password);
            $user->save();

            $response = [
                'success' => true,
                'message' => 'Password changed!',
            ];

            return response()->json($response);
        }

            $response = [
                'success' => false,
                'message' => 'Incorrect verification code!',
            ];
            return response()->json($response);
        }

}
