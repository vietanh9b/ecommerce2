<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Hash;
use App\Models\Category;

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
        return view('frontend.index');
    }

    public function changePasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with('success','Password successfully changed');
    }
    

    public function updateProfile(Request $request){
        User::find(auth()->user()->id)->update(['name'=> $request->get('name')]);
        return redirect()->back()->with('success','Name successfully changed');;
    }      
}

