<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard_page.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        //dd($request->all());

        $request->authenticate();
        $request->session()->regenerate();
        saveLogs('login aplikasi');
        $level = Auth::user()->level;
        if ($level == 'superadmin') :
            return redirect()->intended(RouteServiceProvider::HOME);
        elseif ($level == 'admin') :
            return redirect()->intended(RouteServiceProvider::HOME);
        elseif ($level == 'umum') :
            return redirect()->intended('dashboard/surat-masuk');
        elseif ($level == 'disposisi') :
//            $referer = request()->headers->get('referer');
//            if($referer=='')
            return redirect()->intended('dashboard/surat-masuk');
        else :
            return redirect('/');
        endif;
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        saveLogs('logout aplikasi');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
