<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return response()->json([
            'results' => $users
        ], 200);
    }

    public function show($id) {
        $users = User::find($id);
        
        if (!$users) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'results' => $users
        ], 200);
    }

    public function store(UserStoreRequest $request) {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'message' => 'User successfully created'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
