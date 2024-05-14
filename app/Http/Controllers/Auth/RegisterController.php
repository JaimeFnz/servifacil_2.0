<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'name' => ['required', 'string', 'max:255'],
            'dni' => [
                'required',
                'string',
                'max:9',
                function ($attribute, $value, $fail) {
                    if (!$this->validateDni($value)) {
                        $fail("El DNI $value no es válido.");
                    }
                }   
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /** 
     * Super illegal Spanish ID generator
     * 
     * First selects random numbers, after that a random letter,
     * puts all of it together and checks if that id already exists.
     *  
     */
    function generateID()
    {
        do {
            $dni_number = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
            $dni_letter = $letters[(int) $dni_number % 23];
            $dni_complete = $dni_number . $dni_letter;
            $existing_user = User::where('dni', $dni_complete)->first();
        } while ($existing_user);
        return $dni_complete;
    }

    /**
     * Super legal function to validate an id number
     * 
     * 
     */
    function validateDni($dni)
    {
        return preg_match('/^[0-9]{8}[A-Za-z]$/', $dni);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'dni' => $this->generateID(),
            'name' => $data['name'],
            'surname' => '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_empresa' => 1,
        ]);
    }
}
