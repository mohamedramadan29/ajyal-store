<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
     //   $this->middleware(['auth']);
      //  $this->middleware(['auth'])->only('index');
       // $this->middleware(['auth'])->except(['']);
    }

    public function index(){
        return view('dashboard.index');
    }
}
