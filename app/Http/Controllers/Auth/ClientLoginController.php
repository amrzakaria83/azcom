<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class ClientLoginController extends Controller
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
        $this->middleware('guest')->except('logout');
    }

    public function showClientLoginForm(Request $request)
    {
        return view('client.auth.login');
    }

    public function clientLogin(Request $request)
    {
        $this->validate($request, [
            'phone'   => 'required',
            'password' => 'required|min:6'
        ]);

        $User = User::wherePhone($request->phone)->first();

        if($User){
            if($User->is_active == 1){
                if (Auth::attempt(['phone' => $request->phone,'password' => $request->password], $request->get('remember'))){
                    return back()->with(['success' => 'تم الدخول بنجاح']);
                } else {
                    return back()->with(['error' => 'عفوا كلمة المرور خاطئه  '])->withInput($request->only('phone', 'remember'));
                }
            } else {
                return back()->with(['error' => 'عفوا الحساب غير مفعل  '])->withInput($request->only('phone', 'remember'));
            }
        } else {
            return back()->with(['error' => 'عفوا رقم الجوال خاطئ  '])->withInput($request->only('phone', 'remember'));
        }

        return back()->withInput($request->only('phone', 'remember'));
    }
    public function clientRegister(Request $request)
    {
        if(!$request->name){
            return back()->with(['error' => 'عفوا الاسم مطلوب  ']);
        } else if(!$request->phone){
            return back()->with(['error' => 'عفوا رقم الجوال مطلوب  ']);
        } else if(!$request->email){
            return back()->with(['error' => 'عفوا البريد الالكتروني مطلوب  ']);
        } else if(!$request->password){
            return back()->with(['error' => 'عفوا كلمة المرور مطلوب  ']);
        } else if(!$request->type){
            return back()->with(['error' => 'عفوا النوع مطلوب  ']);
        }
        

        $User = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'is_active' => '1'
        ]);

        if($User){
            if (Auth::attempt(['phone' => $request->phone,'password' => $request->password], $request->get('remember'))){
                return back()->with(['success' => 'تم التسجيل بنجاح']);
            } else {
                return back()->withInput($request->only('phone', 'remember'));
            }
        } else {
            return back()->withInput($request->only('phone', 'remember'));
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}