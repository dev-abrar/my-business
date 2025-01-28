<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class UserController extends Controller
{
    function users()
    {
        return view('pages.dashboard.users');
    }
    function user_list()
    {
        $users = User::where('id', '!=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'photo' => $user->photo
                        ? asset('upload/user/' . $user->photo)
                        : Avatar::create($user->name)->toBase64(), 
                ];
            });

        return response()->json($users);
    }

    function user_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'password.required' => 'Password is required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User Created Successfull!'
        ], status: 201);
    }

    function user_delete(Request $request)
    {
        $present = User::find($request->user_id);
        if ($present->photo != null) {
            unlink(public_path('upload/user/' . $present->photo));
        }
        User::find($request->user_id)->delete();
        return response()->json([
            'status' => 'success',
        ], status: 201);
    }

    function profile()
    {
        return view('pages.dashboard.user_profile');
    }

    function profile_update(Request $request)
    {

        if($request->password != ''){
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }
        else{
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Profile Successfully Updated!',
        ], status: 201);
    }

    function profile_photo(Request $request)
    {
        $present = User::find(Auth::id());
        if ($present->photo != null) {
            unlink(public_path('upload/user/' . $present->photo));
        }

        $img = $request->photo;
        $extension = $img->getClientOriginalExtension();
        $file_name = Auth::id() . '.' . $extension;
        $imgPath = public_path('upload/user/' . $file_name);

        Image::make($img)->resize(200, 200)
        ->save($imgPath, 80);

        User::find(Auth::id())->update([
            'photo' => $file_name,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}
