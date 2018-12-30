<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/home';

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $title = 'Register Kasir';
        return view('auth.register', compact('title'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:kasirs'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'alamat' => ['required', 'string', 'min:10'],
            'telepon' => ['required', 'string', 'min:10'],
            // 'photo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:3096'],
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:3092',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $request = request();
        $img = $request->file('photo');

        $new_name = rand(). '.' . $img->getClientOriginalExtension();
        
        $img->move(public_path('images'), $new_name);  

        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'photo' => $new_name,
            'akses' => 'kasir',
        ]);      
    }
}
