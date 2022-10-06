<?php

namespace App\Http\Controllers\Auth;

use App\Models\Unit;

use App\Models\User;


use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
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
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:employee');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nip' => 'required|unique:users,nip',
            'unit' => 'required',
            'phone' => 'required|unique:users,phone',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    public function showRegistrationForm()
    {
        $unit = Unit::all();
        return view('auth.register', ['unit' => $unit]);
    }



    /**
     * @param array $data
     *
     * @return mixed
     */
    protected function create(Request $request)
    {
        $this->validator($request->all())->validate();
        // dd($request);
        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'id_unit' => $request->unit,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect(url('login'))->with(['info' => 'Akun sukses dibuat!, anda dapat login sekarang']);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    // public function showEmployeeRegisterForm()
    // {
    //     return view('employee.register');
    // }


    // /**
    //  * @param Request $request
    //  *
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // protected function createEmployee(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     Employee::create([
    //         'name' => $request->name,
    //         'nip' => $request->nip,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);
    //     return view('admins.dashboard');
    // }
}
