<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Jobs\UpdateUserAlert;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $data['users'] = $users;
        return view('home', $data);
    }

    public function update(Request $request) {
        $userId = $request->input('id');
        if($userId){
            $name = $request->input('name');
            $email = $request->input('email');

            $findUser = User::find($userId)->update(['name' => $name, 'email' => $email ]);
            if($findUser){
               //dispatching Job
                $alertJob = new UpdateUserAlert();
                dispatch($alertJob);

                return response()->json(['status' => 1, 'message' => "User {$name} updated successfully"]);
            }


            return response()->json(['status' => 0, 'message' => 'error']);
        }
        return response()->json(['status' => 404, 'message' => 'user not found']);
    }
}
