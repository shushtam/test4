<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\PostRegister;
use Auth;

class UserController extends Controller {

    protected $redirectTo = '/login';

    public function showLogin() {
        return \View::make('auth/login');
    }

    public function postLogin(\App\Http\Requests\User\PostLogin $request) {

        /*  $user = User::where('email', $request->input('email'))
          ->where('password', bcrypt($request->input('password')))->first(); */
        $userdata = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );
        if (Auth::attempt($userdata, true)) {
            return \View::make('/home');
        } else {
            return \View::make('auth/login');
        }
    }

    public function showRegister() {
        return \View::make('auth/register');
    }

    public function postRegister(\App\Http\Requests\User\PostRegister $request) {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        return \View::make('/home');
    }

    public function logout() {
        Auth::logout();
        return \View::make('welcome');
    }

    public function showList(\App\Http\Requests\User\PostList $request) {
        $userGroupedArr = new User();


        if ($request->has('name') && $request->has('email')) {
            $userFilter = $userGroupedArr->where('name', 'like', '%' . $request->input('name') . '%')
                    ->where('email', 'like', '%' . $request->input('email') . '%');
        } elseif ($request->has('name')) {
            $userFilter = $userGroupedArr->where('name', 'like', '%' . $request->input('name') . '%');
        } elseif ($request->has('email')) {
            $userFilter = $userGroupedArr->where('email', 'like', '%' . $request->input('email') . '%');
        } elseif ($request->has('role')) {
            $userFilter = $userGroupedArr->where('role', $request->input('role'));
        } else {
            $userFilter = $userGroupedArr;
        }
        $userFilter->get();
        $userArr = $userFilter->paginate(15);
        $request->flash();
        return \View::make('list', [
                    'userArr' => $userArr,
                    'selectedrole'=>$request->input('role')
        ]);
    }

    public function showEdit($id) {
        //return \View::make('edit');
        return view('edit', ['user' => User::findOrFail($id)]);
    }

    public function postEdit(\App\Http\Requests\User\PostEdit $request) {
        $us = User::where('id', $request->id)->first();
        if (strcmp($us->email, $request->input('email')) == 0) {
            User::where('id', $request->id)
                    ->update(['name' => $request->input('name')]);
            return view('edit', ['user' => User::findOrFail($request->id)]);
        } else {
            User::where('id', $request->id)
                    ->update(['name' => $request->input('name'), 'email' => $request->input('email')]);
            return view('edit', ['user' => User::findOrFail($request->id)]);
        }
    }

    public function postChange(\App\Http\Requests\User\PostChange $request) {


        Product::where('id', $request->input('product_id'))
                ->update(['user_id' => $request->input('user_id')]);
    }

    public function postSearch(Request $request) {
        
    }

}
