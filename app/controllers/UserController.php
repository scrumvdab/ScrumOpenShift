<?php

class UserController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    public function getRegister() {
        return View::make('user.register');
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
            $user->adress = Input::get('adress');
            $user->zip = Input::get('zip');
            $user->city = Input::get('city');
            $user->password = Hash::make(Input::get('password'));
            $user->phone = Input::get('phone');
            $user->message = Input::get('message');
            $user->banknr = Input::get('banknr');
            $user->save();

            return Redirect::to('user/login')->with('message', 'Je bent succesvol geregistreerd!');
        } else {
// validation has failed, display error messages
            return Redirect::to('user/register')->with('message', 'Oeps, er ging iets fout!')->withErrors($validator)->withInput();
        }
    }

    public function getLogin() {
        return View::make('user.login');
    }

    public function postSignin() {
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            return Redirect::to('/')->with('message', 'Je bent nu aangemeld!');
        } else {
            return Redirect::to('user/login')
                            ->with('message', 'Je invoer is fout, probeer opnieuw!')
                            ->withInput();
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('user/login')->with('message', 'Je bent nu afgemeld!');
    }

    public function getDashboard() {
        $user = Auth::user();
        return View::make('user.dashboard')->with('user', $user);
    }

    public function getEdit() {
        $user = Auth::user();
        return View::make('user.dashboard_edit')->with('user', $user);
    }

    public function putUpdate() {
        $validation = Validator::make(Input::all(), array(
                    'firstname' => 'required|alpha|min:2',
                    'lastname' => 'required|alpha|min:2',
                    'username' => 'required|alpha',
                    'email' => 'required|email',
                    'password' => 'required|alpha_num|between:6,12|confirmed',
                    'password_confirmation' => 'required|alpha_num|between:6,12'
                        )
        ); //close validation
        //If validation fail send back the Input with errors
        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            // validation has passed, update user in DB       
            $user = Auth::user();
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->adress = Input::get('adress');
            $user->zip = Input::get('zip');
            $user->city = Input::get('city');
            $user->password = Hash::make(Input::get('password'));
            $user->phone = Input::get('phone');
            $user->banknr = Input::get('banknr');
            $user->save();

            return Redirect::to('user/dashboard')->with('message', 'Succesvol aangepast!');
        }
    }

    public function putNews() {
        $validation = Validator::make(Input::all(), array(
                    'news' => 'boolean',
                    'news_extra' => 'boolean'
                        )
        ); //close validation
        //If validation fail send back the Input with errors
        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            // validation has passed, update user in DB       
            $user = Auth::user();
            $user->news = Input::get('news');
            $user->news_extra = Input::get('news_extra');
            $user->save();

            return Redirect::to('user/dashboard')->with('message', 'Succesvol aangepast!');
        }
    }

}
