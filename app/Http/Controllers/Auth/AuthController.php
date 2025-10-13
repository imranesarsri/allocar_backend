<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register API - POST(name , email , password)
    public function register(RegisterRequest $request){
        User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
        return response()->json([
            "status"=>true,
            "message"=>"User registered successfully",
            "data"=>[]
        ]);
    }
    //Login API - POST(emial , password)
    public function login(LoginRequest $request){
        $token = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if(!$token){
            return response()->json([
                "status"=>false,
                "message"=>"invalid login details",
            ]);
        }
        $user = auth()->user();
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');
        $agency = $user->agencies()->first();
        $agency_id = $agency ? $agency->agency_id : null;

        return response()->json([
            "status"=>true,
            "message"=>"User loged in",
            "token"=>$token,
            "expires_in"=>auth()->factory()->getTTL() * 60,
            "user"=>[
                "user_id" => $user->user_id,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "roles" => $roles,
                "permissions" => $permissions,
                "agency_id" => $agency_id, // <-- This line is essential!
            ],
            "roles"=>$roles,
            "permissions"=>$permissions,
        ]);
    }
    //Profile API - GET(JWT Auth Token)
    public function profile() {
    $user = auth('api')->user(); // use the correct guard

    // Make sure roles and permissions are loaded
    $roles = $user->getRoleNames(); // returns a Collection of role names
    $permissions = $user->getAllPermissions()->pluck('name'); // Collection of permission names

    // Return user with roles and permissions explicitly added
    return response()->json([
        'status' => true,
        'message' => 'profile Data',
    'user' => [
        'user_id' => $user->id,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'email' => $user->email,
        'roles' => $roles,
        'permissions' => $permissions,
        'agency_id' => optional($user->agencies()->first())->agency_id,
    ],

    ]);
}

    //Refresh API - GET(JWT Auth Token)
    public function refreshToken(){
        $token = auth()->refresh();
        return response()->json([
            "status"=>true,
            "message"=>"Refresh token",
            "toke"=>$token,
            "expires_in"=>auth()->factory()->getTTL() * 60
        ]);
    }
    //Logout API - GET(JWT Auth Token)
    public function logout(){
        auth()->logout();
        return response()->json([
            "status"=>true,
            "message"=>"User logged out"
        ]);
    }
    //get user by id
    public function getUserById($id){
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'user not found',
            ],404);
        }
        return response()->json([
            'status'=>true,
            'message'=>'User retrieved successfully',
            'data'=>$user
        ]);
    }
    //get all user
    public function getAllUsers(){
        $users = User::all();
        return response()->json([
            'status'=>true,
            'message'=>'Users retrieved successfully',
            'data'=>$users
        ]);
    }
    //update users
    public function update(UpdateRequest $request, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'User not found'
            ],404);
        }
        //first name
        if($request->has('first_name')){
            $user->first_name = $request->first_name;
        }
        //last name
        if($request->has('last_name')){
            $user->last_name = $request->last_name;
        }
        //email
        if($request->has('email')){
            $user->email = $request->email;
        }
        //password
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return response()->json([
            'status'=>true,
            'message'=>'User updated successfully',
            'data'=>$user
        ]);
    }
    // forget password
    public function forgotPassword(ForgetPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'status' => $status === Password::RESET_LINK_SENT,
            'message' => __($status)
        ]);
    }

    //Reset password
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(0.01));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return response()->json([
            'status' => $status === Password::PASSWORD_RESET,
            'message' => __($status)
        ]);
    }
}
