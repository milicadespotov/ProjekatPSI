<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\File;
use \Crypt;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function register(Request $request)
    {
        $request->validate( [
            'username' => 'required|unique:users|max:20',
            'name' => 'max:20',
            'surname' => 'max:30',
            'password' => 'required|min:6|alpha_dash',
            'password_confirm' => 'required_with:password|same:password',
            'email' => 'required|email|unique:users|max:40',
            'security_question' => 'required',
            'answer' => 'required',
            'gender' => 'required'
        ]);

        $user = new User();

        $user->username = $request->username;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->password =  Crypt::encryptString($request->password);
        $user->email = $request->email;
        $user->security_question = $request->security_question;
        $user->answer  = $request->answer;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        if (Input::has('picture')) {
            $file = $request->file('picture')->store('img');
            $filename = $request->name . '-' . $user->username . '.jpg';
            $user->picture_path = $filename;
        }
        $user->save();
        return redirect()->route('login');

    }

}
