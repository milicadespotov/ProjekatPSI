<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function remove($id)
    {

    }

    public function SignIn(Request $request)
    {
        $user_type = "";

        if (isset($_POST['selected_text']))
        {
            $user_type = $_POST['selected_text'];
        }

        if (strcmp($user_type, "Korisnik") == 0)
        {
            echo "user";
            $result = app('');
        }


    }

    public function create()
    {


    }

}
