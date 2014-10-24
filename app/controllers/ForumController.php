<?php

class ForumController extends BaseController {

    public function index() {
        $groups = ForumGroup::all();
        $categories = ForumCategory::all();

        return View::make('forum.index')->with('groups', $groups)->with('categories', $categories);
    }

    public function category($id) {

        $category = ForumCategory::find($id);
        if ($category == null) {
            return Redirect::route('forum-home')->with('fail', "Deze categorie bestaat niet.");
        }
        $threads = $category->threads();
        return View::make('forum.newcategory')->with('category', $category)->with('threads', $threads);
    }

    public function thread($id) {
         $threads = ForumThread::find($id);
        if ($threads == null) {
            return Redirect::route('forum-home')->with('fail', 'Deze thread bestaat niet.');
        }
        $comments = $threads->comments();
        return View::make('forum.newthread')->with('thread', $threads)->with('comments', $comments); 
    }

    public function storeGroup() {
        $validator = Validator::make(Input::all(), array(
                    'group_name' => 'required|unique:forum_groups,title'));

        if ($validator->fails()) {
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal', '#group_form');
        } else {
            $group = new ForumGroup;
            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;
            if ($group->save()) {
                return Redirect::route('forum-home')->with('success', 'The group was created.');
            } else {
                return Redirect::route('forum-home')->with('fail', 'An error occured while saving the new group.');
            }
        }
    }

    /* functie deletegroup 16/10/2014 */

    public function deleteGroup($id) {
        $group = ForumGroup::find($id);
        if ($group == null) {
            return Redirect::route('forum-home')->with('fail', 'Deze groep bestaat niet.');
        }
        $categories = $group->categories();
        $threads = $group->threads();
        $comments = $group->comments();

        $delCa = true;
        $delT = true;
        $delCo = true;
        if ($categories->count() > 0) {
            $delCa = $categories->delete();
        }
        if ($threads->count() > 0) {
            $delT = $threads->delete();
        }
        if ($comments->count() > 0) {
            $delCo = $comments->delete();
        }


        if ($delCa && $delT && $delCo && $group->delete()) {
            return Redirect::route('forum-home')->with('success', 'De groep werd verwijderd');
        } else {
            return Redirect::route('forum-home')->with('fail', 'An error occured while deleting the selected group.');
        }
    }

    public function storeCategory($id) {
        $validator = Validator::make(Input::all(), array(
                    'category_name' => 'required|unique:forum_categories,title'));

        if ($validator->fails()) {
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('category-modal', '#category_modal')->with('group-id', $id);
        } else {
            $group = ForumGroup::find($id);
            if ($group == null) {
                return Redirect::route('forum-home')->with('fail', "That group doesn't exist");
            }

            $category = new ForumCategory;
            $category->title = Input::get('category_name');
            $category->author_id = Auth::user()->id;
            $category->group_id = $id;
            if ($category->save()) {
                return Redirect::route('forum-home')->with('success', 'The group was created.');
            } else {
                return Redirect::route('forum-home')->with('fail', 'An error occured while saving the new category.');
            }
        }
    }
    
    public function deleteCategory($id) {
        $category = ForumCategory::find($id);
        if ($category == null) {
            return Redirect::route('forum-home')->with('fail', 'Deze categorie bestaat niet.');
        }
        $threads = $category->threads();
        $comments = $category->comments();

        $delT = true;
        $delCo = true;

        if ($threads->count() > 0) {
            $delT = $threads->delete();
        }
        if ($comments->count() > 0) {
            $delCo = $comments->delete();
        }


        if ($delT && $delCo && $category->delete()) {
            return Redirect::route('forum-home')->with('success', 'De categorie werd verwijderd');
        } else {
            return Redirect::route('forum-home')->with('fail', 'An error occured while deleting the selected category.');
        }
    }

    public function newThread($id) {
        return View::make('forum.newthread')->with('id', $id);
    }

    public function storeThread($id) {
        $category = ForumCategory::find($id);
        if ($category == null) {
            Redirect::route('forum-get-new-thread')->with('fail', "You posted it to an invalid category");
        }

        $validator = Validator::make(Input::all(), array(
                    'title' => 'required|min:3|max:255',
                    'body' => 'required|min:10|max:65000',
        ));

        if ($validator->fails()) {
            return Redirect::route('forum-get-new-thread', $id)->withInput()->withErrors($validator)->with('fail', "Your thread input doesn't match the required instances");
        } else {
            $thread = new Thread;
            $thread->title = Input::get('title');
            $thread->body = Input::get('body');
            $thread->category_id = $id;
            $thread->group_id = $category->group_id;
            $thread->author_id = Auth::user()->id;

            if ($thread->save()) {
                return Redirect::route('forum-thread')->with('success', 'The thread has been created.');
            } else {
                return Redirect::route('forum-get-new-thread', $id)->with('fail', "An error occured while saving the new thread.")->withInput();
            }
        }
    }

}
