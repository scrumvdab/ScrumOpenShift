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
        $threads = $category->threads()->get();

        return View::make('forum.category')->with('category', $category)->with('threads', $threads);
    }

    public function thread($id) {
        $thread = ForumThread::find($id);
        $comments = ForumComment::all();
        if ($thread == null) {
            return Redirect::route('forum-home')->with('fail', "Deze thread bestaat niet.");
        }
        $author = $thread->author()->first()->username;


        return View::make('forum.thread')->with('thread', $thread)->with('author', $author);
    }

    public function storeGroup() {
        $validator = Validator::make(Input::all(), array(
                    'group_name' => 'required|unique:forum_groups,title'
        ));
        if ($validator->fails()) {
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal', '#group_form');
        } else {
            $group = new ForumGroup;
            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;

            if ($group->save()) {
                return Redirect::route('forum-home')->with('success', 'De groep werd aangemaakt');
            } else {
                return Redirect::route('forum-home')->with('fail', 'Er heeft zich een error voorgedaan bij het aanmaken van uw groep');
            }
        }
    }

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
            return Redirect::route('forum-home')->with('success', 'De groep werd verwijderd.');
        } else {
            return Redirect::route('forum-home')->with('fail', 'Er heeft zich een error voorgedaan bij het verwijderen van uw groep.');
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
            return Redirect::route('forum-home')->with('success', 'De categorie werd verwijderd.');
        } else {
            return Redirect::route('forum-home')->with('fail', 'Er heeft zich een error voorgedaan bij het verwijderen van uw categorie.');
        }
    }

    public function storeCategory($id) {
        $validator = Validator::make(Input::all(), array(
                    'category_name' => 'required|unique:forum_categories,title'
        ));
        if ($validator->fails()) {
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('category-modal', '#category_modal')->with('group-id', $id);
        } else {
            $group = ForumGroup::find($id);
            if ($group == null) {
                return Redirect::route('forum-home')->with('fail', "Deze groep bestaat niet.");
            }

            $category = new ForumCategory;
            $category->title = Input::get('category_name');
            $category->author_id = Auth::user()->id;
            $category->group_id = $id;

            if ($category->save()) {
                return Redirect::route('forum-home')->with('success', 'De categorie werd aangemaakt.');
            } else {
                return Redirect::route('forum-home')->with('fail', 'Er heeft zich een error voorgedaan bij het aanmaken van uw categorie.');
            }
        }
    }

    public function newThread($id) {
        return View::make('forum.newthread')->with('id', $id);
    }

    public function storeThread($id) {
        $category = ForumCategory::find($id);
        if ($category == null)
            Redirect::route('forum-get-new-thread')->with('fail', "U postte een ongeldige categorie.");

        $validator = Validator::make(Input::all(), array(
                    'title' => 'required|min:3|max:255',
                    'body' => 'required|min:10|max:65000'
        ));

        if ($validator->fails()) {
            return Redirect::route('forum-get-new-thread', $id)->withInput()->withErrors($validator)->with('fail', "Uw input voldoet niet aan de vereiste voorwaarden.  <br> Uw titel dient minstens 3 karakters te bevatten. <br> De boodschap dient minstens 10 karakters te bevatten.");
        } else {
            $thread = new ForumThread;
            $thread->title = Input::get('title');
            $thread->body = Input::get('body');
            $thread->category_id = $id;
            $thread->group_id = $category->group_id;
            $thread->author_id = Auth::user()->id;

            if ($thread->save()) {
                return Redirect::route('forum-thread', $thread->id)->with('success', "Uw thread werd bewaard");
            } else {
                return Redirect::route('forum-get-new-thread', $id)->with('fail', "Er heeft zich een error voorgedaan bij het opslaan van uw thread.")->withInput();
            }
        }
    }

    public function deleteThread($id) {
        $thread = ForumThread::find($id);
        if ($thread == null) {
            return Redirect::route('forum-home')->with('fail', "Deze thread bestaat niet");
        }

        $category_id = $thread->category_id;
        $comments = $thread->comments();
        if ($comments->count() > 0) {
            if ($comments->delete() && $thread->delete()) {
                return Redirect::route('forum-category', $category_id)->with('success', "De thread werd verwijderd.");
            } else {
                return Redirect::route('forum-category', $category_id)->with('fail', "Er heeft zich een error voorgedaan bij het verwijderen van uw thread.");
            }
        } else {
            if ($thread->delete()) {
                return Redirect::route('forum-category', $category_id)->with('success', "De thread werd verwijderd.");
            } else {
                return Redirect::route('forum-category', $category_id)->with('fail', "Er heeft zich een error voorgedaan bij het verwijderen van uw thread.");
            }
        }
    }

    /* Comments toegevoegd 21/11/2014 Maarten */

    public function storeComment($id) {
        $thread = ForumThread::find($id);
        if ($thread == null)
            Redirect::route('forum')->with('fail', "That thread does not exist.");
        $validator = Validator::make(Input::all(), array(
                    'body' => 'required|min:5'
        ));
        if ($validator->fails())
            return Redirect::route('forum-thread', $id)->withInput()->withErrors($validator)->with('fail', "Vul uw boodschap correct in. <br> Uw boodschap werd niet bewaard.  <br> Uw boodschap dient minstens 5 karakters te bevatten.");
        else {
            $comment = new ForumComment();
            $comment->body = Input::get('body');
            $comment->author_id = Auth::user()->id;
            $comment->thread_id = $id;
            $comment->category_id = $thread->category->id;
            $comment->group_id = $thread->group->id;
            if ($comment->save())
                return Redirect::route('forum-thread', $id)->with('success', "Uw commentaar werd opgeslagen.");
            else
                return Redirect::route('forum-thread', $id)->with('fail', "Er heeft zich een fout voorgedaan bij het opslaan van uw comment.");
        }
    }

    public function deleteComment($id) {
        $comment = ForumComment::find($id);
        if ($comment == null) {
            return Redirect::route('forum-home')->with('fail', "Deze comment bestaat niet.");
        }
        $threadid = $comment->thread_id;
        if ($comment->delete()) {
            return Redirect::route('forum-thread', $threadid)->with('success', "De comment werd verwijderd.");
        } else {
            return Redirect::route('forum-thread', $threadid)->with('fail', "Er heeft zich een fout voorgedaan bij het verwijderen van uw comment.");
        }
    }

    /* Comments toegevoegd 21/11/2014 Maarten */
    
    public function vote() {
        
    }
}

