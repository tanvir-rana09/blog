<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NameController extends Controller
{
  public function setting_index()
  {
    $users = user::all();
    return view('dashboard.setting.index', compact('users'));
  }

  public function user_destroy($id){
    $user = User::where('id',$id)->first();

    User::find($user->id)->delete();
    return redirect()->route('setting.index')->with('cat_success' , "User Delete Successfull");


}

public function problem_index(){
    return view('dashboard.probelm.index');
}
}
