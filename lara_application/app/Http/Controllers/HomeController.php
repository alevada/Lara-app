<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\User;
use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Determine redirect path
     * method: GET
     * route: /
     */
    public function getAuth ()
    {
        // logged in
        if (Auth::check()) {
            return Redirect::to('/home');

            /*
            if (Auth::user()->isPublisher())
                return Redirect::to('/posts');
            else
                return Redirect::to('/home');
                */
       
        // not logged in
        } else
            return Redirect::to('/login');
    }

    public function getIndex() 
    {
        if (Auth::user()->isPublisher()) {
            $posts = Post::where('author_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->with(['author'])
            ->get();
        } else {
            $posts = Post::where('id', '>', 0) // hack
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->with(['author'])
            ->get();
        }
        
        return view('home.index')
            ->with('posts', $posts);
    }





    public function getSearchResult (Request $request)
    {
        $search_term = trim($request->input('query'));

        if (Auth::user()->isPublisher()) {
            $posts = Post::where('author_id', Auth::user()->id)
                ->where('title', 'like', '%'.$search_term.'%')
                ->orWhere('content', 'like', '%'.$search_term.'%')
                ->orderBy('created_at', 'desc')
                ->with(['author'])
                ->get();

        } else {
            $posts = Post::where('title', 'like', '%'.$search_term.'%')
                ->orWhere('content', 'like', '%'.$search_term.'%')
                ->orderBy('created_at', 'desc')
                ->with(['author'])
                ->get();
        }

        return view('post.search')
            ->with('posts', $posts)
            ->with('search_term', $search_term);
    }
}
