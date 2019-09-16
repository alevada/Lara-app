<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\User;
use App\UserRole;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::user()->isAdmin()) {
            $posts = Post::with('author')
                ->get();

        } else {
            $posts = Post::where('author_id', Auth::user()->id)
                ->with('author')
                ->get();
        }
       

        return view('post.index')
            ->with('posts', $posts);
    }

    public function create()
    {
        $post = new Post();

        // publisher list
        $publisher_role_id  = UserRole::where('slug', 'publisher')->select('id')->first()->id;
        $all_publishers     = User::where('role_id', $publisher_role_id)
            ->select('id', 'first_name', 'last_name')
            ->get();

        $authors_list = [];
        if (count($all_publishers)) {
            $authors_list[null] = '-- Select Publisher';
            foreach ($all_publishers as $publisher) {
                $authors_list[$publisher->id] = trim(implode(' ', [$publisher->first_name, $publisher->last_name]));
            }
        }
        // END publisher list

        // category list
         $all_categories = Category::where('id', '>', 0) // hack
            ->orderBy('name', 'asc')
            ->get();

        $categories_list = [];
         if (count($all_categories)) {
            $categories_list[null] = '-- Select Category';
            foreach ($all_categories as $categ) {
                $categories_list[$categ->id] = $categ->name;
            }
        }
        // END category list

        return view('post.add')
            ->with('post', $post)
            ->with('categories_list', $categories_list)
            ->with('authors_list', $authors_list);
    }


    public function store()
    {
        $validation = Validator::make(Input::all(), Post::rules(), Post::messages());

        if ($validation->passes()) {
            $post = new Post;

            try {
                $post->title        = Input::get('title');
                $post->content      = Input::get('content');
                $post->author_id    = Auth::user()->isPublisher() ? Auth::user()->id : Input::get('author_id');
                $post->category_id  = Input::get('category_id');
    
                $post->save();

            } catch (\Exception $e) {
                //throw $e;

                Flash::warning('Post cannot be created.'); dd($e); //<<<<<<<<<<<</////////////

                return redirect('/post');
            }

            Flash::success('Post created successfully');

            return redirect('/post');

        }

        return redirect('post/create')
            ->withInput()
            ->withErrors($validation);
    }

    public function show($id)
    {

        // get post with all related models
        $post = Post::findOrFail($id);

        if (!empty($post)) {
            // category list
             $all_categories = Category::where('id', '>', 0) // hack
                ->orderBy('name', 'asc')
                ->get();

            $categories_list = [];
             if (count($all_categories)) {
                $categories_list[null] = '-- Select Category';
                foreach ($all_categories as $categ) {
                    $categories_list[$categ->id] = $categ->name;
                }
            }
            // END category list


            if ($post->author_id == Auth::user()->id) {
                return view('post.edit')
                    ->with('post', $post)
                    ->with('categories_list', $categories_list);

                } else if (Auth::user()->isAdmin()) {
                    // publisher list
                    $publisher_role_id  = UserRole::where('slug', 'publisher')->select('id')->first()->id;
                    $all_publishers     = User::where('role_id', $publisher_role_id)
                        ->select('id', 'first_name', 'last_name')
                        ->get();

                    $authors_list = [];
                    if (count($all_publishers)) {
                        foreach ($all_publishers as $publisher) {
                            $authors_list[$publisher->id] = trim(implode(' ', [$publisher->first_name, $publisher->last_name]));
                        }
                    }
                    // END publisher list

                    return view('post.edit')
                        ->with('post', $post)
                        ->with('categories_list', $categories_list)
                        ->with('authors_list', $authors_list);
                }

            return redirect('/');

        } else {
            Flash::warning('Post not found');

            return redirect('/post');
        }
    }


    public function update($id)
    {

        // get location of action if available from multiple locations
        $location = Input::get('location');
        $location = empty($location) ? 'home' : $location;
        // END get location of action if available from multiple locations

        $post = Post::findOrFail($id);

        $validation = Validator::make(Input::all(), Post::rules($id), Post::messages());

        if ($validation->passes()) {
            try {
                // dd(Input::all());

                $post->title        = Input::get('title');
                $post->content      = Input::get('content');
                $post->author_id    = Auth::user()->isPublisher() ? Auth::user()->id : Input::get('author_id');
                $post->category_id  = Input::get('category_id');

                if ($post->author_id == Auth::user()->id || Auth::user()->isAdmin()){
                    $post->save();
                }

            } catch (\Exception $e) {
                //dd($e);
                Flash::warning('Post cannot be updated');

                return redirect('/'.$location);
            }

            
            Flash::success('Post updated successfully');
          

            return redirect('/'.$location);

        }

        Flash::warning('Post could not be updated');

        return redirect('post/' . $id)
            ->withInput()
            ->withErrors($validation);
    }

    public function fakeDestroy($id) 
    {

        // get location of action if available from multiple locations
        $location = Input::get('location');
        $location = empty($location) ? 'home' : $location;
        // END get location of action if available from multiple locations

        $post = Post::findOrFail($id);

        if (empty($post)) {
            Flash::warning('Post not found');

            return redirect('/'.$location);
        }
        $post->delete();

        Flash::success('Post was successfully deleted');

        return redirect('/'.$location);
    }
}
