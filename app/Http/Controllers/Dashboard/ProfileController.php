<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();
        return view('dashboard.profile.edit',[
            "user"=>$user
        ]);
    }
    public function update(Request $request){
        $user = $request->user();
    }
}
