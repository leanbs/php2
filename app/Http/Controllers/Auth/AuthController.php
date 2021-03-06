<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * Path to redirect when authentication fails.
     *
     * @var string
     */
    protected $loginPath = '/manage/akun';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/manage/akun';

    /**
     * Login identifier (the one used in form <input name="">). This should
     * also represents the database column used, whereas we uses 'Email', it
     * should be fine, because database column is pretty much case-insensitive.
     *
     * @var string
     */
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    /**
     * Path to redirect after logging out.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/login';

    public function __construct()
    {
       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

        public function getLogin()
    {
        return view('layouts.public.login');
    }

    public function getRegister()
    {
        return view('layouts.public.register');
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        if (! empty($error = $this->create($request->all()))) {
            return redirect()->back()->withErrors([
                $error,
            ]);
        } else {
            return redirect($this->loginPath)
                ->with('status', 'Your account has been created, check your email to setup password.');
        }
    }
}
