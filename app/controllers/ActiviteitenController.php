<?php

class ActiviteitenController extends BaseController {

    public function main() {
        $activities = Activity::all();
        return View::make('activiteiten')->with('activities', $activities);
    }

    public function add() {
        return View::make('activiteiten_add');
    }

    public function add_activity() {
        $validation = Validator::make(Input::all(), array(
                    'title' => 'required|min:2|max:100',
                    'body' => 'required|min:2',
                    'place' => 'required|min:2|max:50',
                    'date_start' => 'required|min:8|max:10',
                    'date_end' => 'required|min:8|max:10',
                    'time_start' => 'required|date_format|min:4|max:4',
                    'time_end' => 'required|min:4|max:4',
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
            $activities->date_start = Input::get('date_start');
            $activities->date_end = Input::get('date_end');
            $activities->time_start = Input::get('time_start');
            $activities->time_end = Input::get('time_end');
            $activities->title = Input::get('title');
            $activities->body = Input::get('body');
            $activities->place = Input::get('place');
            $activities->save();

            return Redirect::to('activiteiten')->with('message', 'Activiteit is succesvol toegevoegd');
        }
    }

    /*

      public function add_activity() {

      $validator = Validator::make(Input::all(), Activity::$rules);

      if ($validator->passes()) {

      // validation has passed, save user in DB

      $activities = new Activity();
      $activities->date_start = Input::get('date_start');
      $activities->date_end = Input::get('date_end');
      $activities->time_start = Input::get('time_start');
      $activities->time_end = Input::get('time_end');
      $activities->title = Input::get('title');
      $activities->body = Input::get('body');
      $activities->place = Input::get('place');
      $activities->save();

      return Redirect::to('activiteiten')->with('message', 'Activiteit is succesvol toegevoegd');
      } else {
      // validation has failed, display error messages
      return Redirect::to('activiteiten_add')->with('message', 'Oeps, er ging iets fout!')->withErrors($validator)->withInput();
      }


      }
     */
}
