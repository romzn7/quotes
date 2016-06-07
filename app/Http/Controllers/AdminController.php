<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\CreateAdminRequest;
use App\Author;

class AdminController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }

    public function getDashboard(){
        
    	$authors = Author::all();
    	return view('admin.dashboard', ['authors' => $authors]);
    }

    public function postLogin(CreateAdminRequest $request){
    	

    	if(!Auth::attempt(['name' => $request['username'], 'password' => $request['password']])){

    		return redirect()->back()->with(['fail' => 'Invalid Username/Password']);
    	}
    	return redirect()->route('admin.dashboard');
        
    }

     public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
