<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','user']);
    }

    /**
     * Show the application dashboard user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('home.index');
    }
}
