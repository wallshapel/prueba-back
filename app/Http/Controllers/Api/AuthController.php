<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller {

    public function register(Request $req) {   

        $validator = \Validator::make($req->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        return response($user, 201);

    }

    public function index() {

        $users = User::all();

        return response()->json($users, 200);

    }

    public function destroy($id) {

        $user = User::find($id);

        if (!$user)
            return response()->json(['message' => 'User not found'], 404);

        $user->delete();

        return response()->json(['message' => 'User deleted'], 204);

    }
}
