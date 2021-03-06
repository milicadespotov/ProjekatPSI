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

        $rules = array(
            'username' => 'required|unique:users|max:20',
            'name' => 'max:20',
            'surname' => 'max:30',
            'password' => 'required|min:6|alpha_dash',
            'password_confirm' => 'required_with:password|same:password',
            'email' => 'required|email|unique:users|max:40',
            'security_question' => 'required',
            'answer' => 'required',

        );

        $messages = array(
            'username.required'=> 'Ovo polje je obavezno',
            'username.unique' => 'Korisničko ime već postoji, izaberite drugo',
            'username.max' => 'Korisnicko ime mora da bude manje od :max karaktera',
            'email.required'=>' Ovo polje je obavezno',
            'email.unique' => 'Već postoji korisnik sa ovim e-mailom',
            'name.max' => 'Ime ne sme biti duže od :max slova',
            'surname.max' => 'Prezime ne sme biti duže od :max slova',
            'password.required' => 'Ovo polje je obavezno',
            'password.min' => 'Lozinka ne sme biti manja od :min',
            'password.alpha_dash' => 'Lozinka sme sadržati samo alpa_dash karaktere',
            'password_confirm.required_with' => 'Ovo polje je obavezno',
            'password_confirm.same' => 'Ponovljena lozinka mora biti ista kao inicijalno unesena',
            'email.max'=>'E-mail ne sme biti duži od :max karaktera',
            'security_question.required' => 'Ovo polje je obavezno',
            'answer.required' => 'Ovo polje je obavezno',

        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();

        $user->username = $request->username;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->password =  Hash::make($request->password);
        $user->email = $request->email;
        $user->security_question = $request->security_question;
        $user->answer  = $request->answer;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $file = $request->picture;
        if ($request->hasFile('picture')) {

            $filename = $request->name . '-' . $user->username . '.jpg';
            $file = $file->storeAs('img\users', $filename);
            $user->picture_path = $filename;
        }
        $user->save();
        return redirect()->route('login');

    }

}
