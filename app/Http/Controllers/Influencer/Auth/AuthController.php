<?php

namespace App\Http\Controllers\Influencer\Auth;

use App\Enums\ArtistStatus;
use App\Http\Controllers\Controller;
use App\Models\Influencer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:influencer')->except('logout');
    }

    public function showLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('backend-influencer.auth.login', ['pageConfigs' => $pageConfigs]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);


        $influencer = Influencer::where('username', $request->username)->first();

        // Attempt to log the user in
        if (Auth::guard('influencer')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('influencer.dashboard'));
        }

        $errors = [
            'username' => 'username or password is incorrect',
        ];

        return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($errors);
    }

    public function logout(Request $request)
    {
        auth('influencer')->logout();
        $request->session()->invalidate();
        return redirect(route('influencer.login_form'));
    }
}
