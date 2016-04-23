<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

    public function getLogin()
    {
        $data = [
            'email' => 'riaplopes@gmail.com',
            'password' => 123456

        ];

        if(Auth::check()){
            return "Logado";
        }


        if(Auth::attempt($data)){
            return "logou";
        }

        return "falhou";

    }

    public function getLogout()
    {
        Auth::logout();

        if(Auth::check()) {
            return "Logado";
        }

        return "Não está logado";
    }


}
