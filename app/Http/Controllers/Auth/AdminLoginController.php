<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Employee;
use Auth;

class AdminLoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $employee = Employee::whereEmail($request->email)->first();

        if($employee){
            if($employee->is_active == 1){
                if ($employee->type == 'teacher') {
                    if (Auth::guard('teacher')->attempt(['email' => $request->email,'password' => $request->password, 'type' => $employee->type], $request->get('remember'))){
                        return redirect()->intended('/teacher');
                    } else {
                        return back()->withErrors(['password' => trans('auth.error_password') ])->withInput($request->only('email', 'remember'));
                    }
                } else {
                    if (Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password, 'type' => $employee->type], $request->get('remember'))){
                        return redirect()->intended('/admin');
                    } else {
                        return back()->withErrors(['password' => trans('auth.error_password') ])->withInput($request->only('email', 'remember'));
                    }
                }
                
            } else {
                return back()->withErrors(['email' => trans('auth.error_is_active')])->withInput($request->only('email', 'remember'));
            }
        } else {
            return back()->withErrors(['email' => trans('auth.error_email')])->withInput($request->only('email', 'remember'));
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        Auth::guard('teacher')->logout();
        return redirect('/');
    }

}
