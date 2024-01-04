<?php

namespace App\Http\Controllers\brand\Auth;

use App\Enums\BrandType;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:brand')->except('logout');
    }

    public function showLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('backend-brand.auth.login', ['pageConfigs' => $pageConfigs]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);


        $brand = Brand::where('username', $request->username)->first();

        if ($brand->status !== BrandType::Luxury) {
            $errors = [
                'username' => 'username or password is incorrect',
            ];

            return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($errors);
        }

        // Attempt to log the user in
        if (Auth::guard('brand')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('brand.dashboard'));
        }

        $errors = [
            'username' => 'username or password is incorrect',
        ];

        return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($errors);
    }

    public function logout(Request $request)
    {
        auth('brand')->logout();
        $request->session()->invalidate();
        return redirect(route('brand.login_form'));
    }
}
