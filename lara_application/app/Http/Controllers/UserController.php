<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Redirect;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('role')->where('role_id', '!=', '1')->get();

        return view('user.index')
            ->with('users', $users);
    }

    public function create()
    {

        $user = new User();

        return view('user.add')
            ->with('user', $user);
    }

    public function store()
    {
        $validation = Validator::make(Input::all(), User::rules(), User::messages());

        if ($validation->passes()) {
            $user = new User;

            try {
                $user->first_name = Input::get('first_name');
                $user->last_name  = Input::get('last_name');
                $user->email      = Input::get('email');
                $user->status     = Input::get('status');

                if (!empty(Input::get('password')))
                    if (Input::get('password') == Input::get('password_confirmation'))
                        $user->password = bcrypt(Input::get('password'));

                $user->save();

            } catch (\Exception $e) {
                //throw $e;

                Flash::warning('User cannot be created.');

                return redirect('/user');
            }

            Flash::success('User created successfully');

            return redirect('/user');

        }

        return redirect('user/create')
            ->withInput()
            ->withErrors($validation);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (empty($user)) {
            Flash::warning('User not found');

            return redirect('/user');
        }

        if ($user->role_id > 2) {

            $user->status = 'I';
            $user->save();

            Flash::success('User was successfully deleted');
        } else {
            Flash::warning('This user cannot be deleted');
        }

        return redirect('/user');
    }


    public function show($id)
    {
        // get user with all related models
        $user = User::findOrFail($id);

        if (!empty($user)) {
            if ($user->id == Auth::user()->id || Auth::user()->isAdmin())
                return view('user.edit')
                    ->with('user', $user);

            return redirect('/');

        } else {
            Flash::warning('User not found');

            return redirect('/user');
        }
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $validation = Validator::make(Input::all(), User::rules($id), User::messages());

        if ($validation->passes()) {
            try {
                // dd(Input::all());

                $user->first_name = Input::get('first_name');
                $user->last_name  = Input::get('last_name');
                $user->email      = Input::get('email');

                if ($user->isAdmin()) {
                    $user->status = Input::get('status');
                }

                if (!empty(Input::get('password')))
                    if (Input::get('password') == Input::get('password_confirmation'))
                        $user->password = bcrypt(Input::get('password'));

                    

                //if ($user->role_id > 1) { // do not edit admin account
                if ($user->id == Auth::user()->id || Auth::user()->isAdmin()){
                    $user->save();
                }

            } catch (\Exception $e) {
                //dd($e);
                Flash::warning('User cannot be updated');

                return redirect(Auth::user()->isAdmin() ? '/user' : '/home');
            }

            
            Flash::success('User updated successfully');
          

            return redirect(Auth::user()->isAdmin() ? '/user' : '/home');
        }

        Flash::warning('User could not be updated');

        return redirect('user/' . $id)
            ->withInput()
            ->withErrors($validation);
    }
}