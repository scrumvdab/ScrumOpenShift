<?php

class ApplyController extends BaseController {

    public function upload() {
        Auth::user();
        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required', 'mimes:jpg', 'max:5000', 'min:4');
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('user/dashboard')->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = Auth::user()->id. '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Uw avatar is aangepast');
                return Redirect::to('user/dashboard');
            } else {
                // sending back with error message.
                Session::flash('error', 'Het bestand is ongeldig');
                return Redirect::to('user/dashboard');
            }
          
        }
    }

}
