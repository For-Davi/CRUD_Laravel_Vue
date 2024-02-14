<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'Registrado com sucesso!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, true)) {
            $success = true;
            $message = 'Usuário logado com sucesso!';
        } else {
            $success = false;
            $message = 'Unauthorised';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            
            $cookies = Cookie::get();
            foreach ($cookies as $cookieName => $value) {
            Cookie::queue(Cookie::forget($cookieName));
            }

            $message = 'Usuário deslogado com sucesso!';

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        // return response()->json($response);
        return Redirect::to('/login')->with(['success' => $success, 'message' => $message]);
    }
}
