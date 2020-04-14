<?php

namespace app\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    protected $data = []; // the information we send to the view

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $guard = backpack_guard_name();

        $this->middleware("guest:$guard");

        // Where to redirect users after login / registration.
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo
            : config('backpack.base.route_prefix', 'dashboard');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $user_model_fqn = config('backpack.base.user_model_fqn');
        $user = new $user_model_fqn();
        $users_table = $user->getTable();
        $email_validation = backpack_authentication_column() == 'email' ? 'email|' : '';

        return Validator::make($data, [
            'name'                             => 'required|max:255',
            backpack_authentication_column()   => 'required|'.$email_validation.'max:255|unique:'.$users_table,
            'password'                         => 'required|min:6|confirmed',
            'namaLengkap'                      => 'required|max:255',
            'alamat'                           => 'required|max:255',
            'nomorKtp'                         => 'required|min:16|max:255',
            'noHp'                             => 'required|min:12|max:255',
            'fotoKtp'                          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user_model_fqn = config('backpack.base.user_model_fqn');
        $user = new $user_model_fqn();
        $file_name = str_slug($data['fotoKtp']).'.jpg';


        return $user->create([
            'name'                             => $data['name'],
            backpack_authentication_column()   => $data[backpack_authentication_column()],
            'password'                         => bcrypt($data['password']),
            'namaLengkap'                      => $data['namaLengkap'],
            'alamat'                           => $data['alamat'],
            'nomorKtp'                         => $data['nomorKtp'],
            'noHp'                             => $data['noHp'],
            'fotoKtp'                          => $file_name,
            'role_id'                          => '1',
            'confirmed'                        => '0'
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // if registration is closed, deny access
        if (! config('backpack.base.registration_open')) {
            abort(403, trans('backpack::base.registration_closed'));
        }

        $this->data['title'] = trans('backpack::base.register'); // set the page title

        return view(('auth.register'), $this->data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // if registration is closed, deny access
        if (! config('backpack.base.registration_open')) {
            abort(403, trans('backpack::base.registration_closed'));
        }
        $user_model_fqn = config('backpack.base.user_model_fqn');
        $user = new $user_model_fqn();

        $this->validator($request->all())->validate();
        
        // $file_name = uniqid().str_slug($request->judul).'.jpg';
        // $file_name = uniqid().'.jpg';
        $file_name = str_slug($request->fotoKtp).'.jpg';
        //$request->fotoKtp->move(public_path('../../uploads/images/fotoktp'),$file_name);
        $request->file('fotoKtp')->move(public_path('/uploads/images/fotoktp'),$file_name);

        $user = $this->create($request->all());
        // $user->fotoKtp = $file_name;

        event(new Registered($user));
        $this->guard()->login($user);

        return redirect('/');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return backpack_auth();
    }
}
