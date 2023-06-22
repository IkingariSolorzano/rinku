<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        dd('sali de validar');

        //Alta de los datos
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        // Respuesta

        return response()->json([
            "mensaje" => "Todavía te quejas"
        ]);
    }

    public function login()
    {
        return response()->json([
            'message' => 'Este es mi mensaje'
        ]);
    }

    public function userProfile()
    {
    }

    public function logout()
    {
    }

    public function allUsers()
    {
    }
}
