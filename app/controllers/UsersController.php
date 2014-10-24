<?php

class UsersController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    public function getRegister() {
        return View::make('users.register');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->phone = Input::get('phone');
            $user->message = Input::get('message');
            $user->save();

            return Redirect::to('users/login')->with('message', 'Je bent succesvol geregistreerd!');
        } else {
            // validation has failed, display error messages
            return Redirect::to('users/register')->with('message', 'Oeps, er ging iets fout!')->withErrors($validator)->withInput();
        }
    }

    public function getLogin() {
        return View::make('users.login');
    }

    public function postSignin() {
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
            return Redirect::to('users/dashboard')->with('message', 'Je bent nu aangemeld!');
        } else {
            return Redirect::to('users/login')
                            ->with('message', 'Je e-mail/wachtwoord was fout')
                            ->withInput();
        }
    }

    public function getDashboard() {
        return View::make('users.dashboard');
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')->with('message', 'Je bent nu afgemeld!');
    }

}
