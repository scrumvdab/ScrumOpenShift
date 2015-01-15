<?php

class ActiviteitenController extends BaseController {

    public function main() {
        $activities = Activity::all();
        return View::make('activiteiten')->with('activities', $activities);
    }

    public function add() {
        return View::make('activiteiten_add');
    }

    public function galery() {
        return View::make('activiteiten_image_galery');
    }

    public function upload() {
        return View::make('activiteiten_upload');
    }
    
    public function add_activity() {
        $validation = Validator::make(Input::all(), array(
                    'title' => 'required|min:2|max:100',
                    'body' => 'required|min:2',
                    'place' => 'required|min:2|max:50',
                   /* 'date_start' => 'required',
                    'date_end' => 'required',
                    'time_start' => 'required',
                    'time_end' => 'required'*/
                        )
        ); //close validation
        //If validation fail send back the Input with errors
        if ($validation->fails()) {
            //withInput keep the users info
            //return Redirect::to('activiteiten_add')->with('message', 'Oeps, er ging iets fout!')->withErrors($validation->messages());
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            // validation has passed, update activiteiten in DB   
            $activities = new Activity();
            $activities->title = Input::get('title');
            $activities->place = Input::get('place');
            $activities->body = Input::get('body');
            $activities->date_start = Input::get('date_start');
            $activities->time_start = Input::get('time_start');
            $activities->date_end = Input::get('date_end');
            $activities->time_end = Input::get('time_end');  
            $activities->save();
            
            return Redirect::to('activiteiten')->with('message', 'Activiteit is succesvol toegevoegd');
        }
    }
    
    public function edit() {
        return View::make('activiteiten_edit')->with('activities', $activities);
    }
    
    public function edit_activity() {
        $validation = Validator::make(Input::all(), array(
                    'title' => 'required|min:2|max:100',
                    'body' => 'required|min:2',
                    'place' => 'required|min:2|max:50',
                    'date_start' => 'required',
                    'date_end' => 'required',
                    'time_start' => 'required',
                    'time_end' => 'required',
                        )
        ); //close validation
        //If validation fail send back the Input with errors
        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            // validation has passed, update user in DB       
            $activities = new Activity();
            $activities->title = Input::get('title');
            $activities->place = Input::get('place');
            $activities->body = Input::get('body');
            $activities->date_start = Input::get('date_start');
            $activities->time_start = Input::get('time_start');
            $activities->date_end = Input::get('date_end');
            $activities->time_end = Input::get('time_end');  
            $activities->save();
            
            return Redirect::to('activiteiten')->with('message', 'Succesvol aangepast!');
        }
    }

}