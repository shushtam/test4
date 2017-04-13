<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Report;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\PostRegister;
use Auth;
use DB;

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
                    'selectedrole' => $request->input('role')
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

    public function showReport(\App\Http\Requests\User\ShowReport $request) {
        $userFilter = Report::select('users.*', 'reports.user_id', DB::raw('MAX(reports.created_at) as report_date'), DB::raw('SUM(reports.value) as total_values')
                )
                ->rightJoin('users', 'reports.user_id', '=', 'users.id')
                ->groupBy('users.id', DB::raw('YEAR(reports.created_at)'), DB::raw('WEEK(reports.created_at)'));
        //$userFilter->having('total_values','=','')->update(['total_values'=>'0']);
        if ($request->has('name')) {
            $userFilter->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('email')) {
            $userFilter->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->has('min_value')) {
            $userFilter->having('total_values', '>', $request->input('min_value'));
        }
        if ($request->has('max_value')) {
            $userFilter->having('total_values', '<', $request->input('max_value'));
        }

        if ($request->has('role')) {
            $userFilter->where('role', $request->input('role'));
        }
        $userFilter = $userFilter->get();
        $userArr = new \Illuminate\Pagination\LengthAwarePaginator(array_slice($userFilter->toArray(), \Request::get('page', 0) * 15, 15), count($userFilter), 15);
        $userArr->setPath('report');
        $request->flash();
        return \View::make('reports', [
                    'userGroupedArr' => $userArr
        ]);
        // return view('reports', ['userGroupedArr' => $userGroupedArr]);
    }

    public function showReportChart(\App\Http\Requests\User\ShowReportChart $request) {
        $user = new User();
        $start_month = $request->input('start_month') + 1;
        $end_month = $request->input('end_month') + 1;
        $userArr = Report::select('users.*', 'reports.user_id', DB::raw('SUM(reports.value) as total_values'), DB::raw('MONTH(reports.created_at) as month'), DB::raw('YEAR(reports.created_at) as year'))
                ->rightJoin('users', 'reports.user_id', '=', 'users.id')
                ->groupBy('users.id', DB::raw('YEAR(reports.created_at)'), DB::raw('MONTH(reports.created_at)'))
                ->having('user_id', '=', $request->input('user'))
                ->having('year', '=', $request->input('year'))
                ->having('month', '>=', $start_month)
                ->having('month', '<=', $end_month);
        $userArr = $userArr->get();
        $user = $user->pluck('name', 'id');
        $request->flash();
        return \View::make('reportschart', [
                    'userArr' => $userArr,
                    'user' => $user,
                    'start' => $start_month,
                    'end' => $end_month
        ]);
    }

    public function imgParam(Request $request) {

        if ($request->ajax()) {
            return 1;
        }
    }

    public function getUsers(Request $request) {
        $user = new User();
        $user = $user->get();
        $user = json_encode($user);
        return $user;
    }

    public function getUser(Request $request) {
        $id = $request->userId;
        $user = User::find($id);
        // $user = json_encode($user);
        //  if (strcmp($user->email,$request->userEmail) == 0) {
        return response()->json(['dt' => $user]);
    }

    public function postUser(\App\Http\Requests\User\PostUser $request) {
        $id = $request->userId;
        $user = User::find($id);
        if ($request->has('email')) {
            User::where('id', $id)
                    ->update(['email' => $request->email]);
        }
        if ($request->has('name')) {
            User::where('id', $id)
                    ->update(['name' => $request->name]);
        }
        return response()->json(['dt' => $user]);
    }

    public function getTasks() {
        $tasks = Task::with('users')->get()->keyBy('id')->toArray();
        return response()->json(['dt' => $tasks]);
    }

    public function updateTasks(Request $request) {
        DB::table('task_user')
                ->where('user_id', $request->user_id)
                ->where('task_id', $request->task_id)
                ->update(['task_id' => $request->newtask_id]);
        return response()->json(['dt' => 'ok']);
    }

    public function addTask(Request $request) {
        $data = [];
        for ($i = 0; $i < count($request->users); $i++) {
            $data[] = ['user_id' => $request->users[$i], 'task_id' => $request->task_id];
        }
        DB::table('task_user')->insert($data);
        return response()->json(['dt' => 'ok']);
    }

    public function removeUser(Request $request) {
        DB::table('task_user')
                ->where('user_id', $request->userId)
                ->where('task_id', $request->task_id)
                ->delete();
        return response()->json(['dt' => 'ok']);
    }

}
