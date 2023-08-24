<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\LoginRequest;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(LoginRequest $request)
    {
        $user= User::query()
            ->where('email',$request->get('email'))
            ->where('password',$request->get('password'))
            ->first();
        if (isset($user)){
            $level=$user->level;
            $role= array_search($level, UserRoleEnum::getRole(), true);
            Auth::login($user);
            return redirect()->route("$role.index");
        }
        return back();
    }
    public function register()
    {
        return view('auth.register');
    }
    public function processRegister()
    {

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
