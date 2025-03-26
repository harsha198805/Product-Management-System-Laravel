<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->authenticated($request, $user);
        }

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided email address does not exist.',
            ]);
        }
        return back()->withErrors([
            'password' => 'The provided password is incorrect.',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        $this->userLoginLog($request);
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function userLoginLog($request)
    {
        try {
            $userAgent = $request->userAgent();
            $ipAddress = $request->ip();
            $userId = Auth::id();

            UserLog::create([
                'user_id'    => $userId,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);

            return true;
        } catch (\Exception $e) {

            return false;
        }
    }
}
