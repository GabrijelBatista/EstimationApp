<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get_users()
    {
        $users=User::get()->all();
        foreach($users as $user){
            $user->title=$user->role->name;
        }

        return response()->json($users);
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 1,
            'password' => Hash::make($request->password),
        ]);

        $response = [
            'success' => true,
            'message' => 'Account registered!'
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
        $response = [
            'success' => true,
            'message' => 'Profile updated!',
            'user' => $user,
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
        } else {
            $success = false;
            $message = 'Wrong credentials!';
        }

        $user=Auth::user();
        if($user)
        {
            $user->date = $user->created_at->format("d. M Y.");
            $user->title = $user->role->name;
            $user->unreadNotifications->sortByDesc('created_at');
        }
        $response = [
            'success' => $success,
            'message' => $message,
            'user' => $user
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

}
