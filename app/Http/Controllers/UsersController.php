<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UsersFormRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(Auth::user()){
            return redirect()->route('series.index'); 
        }
        return view("users.index");
    }

    public function validateLogin(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        $auth = Auth::attempt($request->only(['email','password']));
        if(!$auth){
            return redirect()->route('login')->withErrors('User or email not found.'); 
        }
        return redirect()->route('series.index'); 
    }

    public function store(UsersFormRequest $request){
        $fields = $request->except('_token');
        $fields['password'] = Hash::make($fields['password']);
        $user = User::create($fields);
        Auth::login($user);
        return redirect()->route('series.index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
