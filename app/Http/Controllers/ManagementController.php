<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Sessionllers;
use Illuminate\Support\Str;


class ManagementController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'manager')->get();
        return view('dashboard.management.auth.register', compact('managers'));
    }
    // create session here.
    public function store_register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        return back()->with('store_register' , "User Create  Complete...!!");
    }
    // acctiv  deactive session here.
    public function manager_down($id){
        $manager = User::where('id',$id)->first();


        if($manager->role == 'manager'){
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            return back()->with('register_complete' , "Manager Demotion Successfull");

        }
    }

// manager delete session
    public function manager_delete($id,)
    {
        $manager = User::find($id);
        if ($manager) {
            $manager->delete();
            return redirect()->route('management.index')->with('store_register', "Manager Delete Successful");
        }
        return redirect()->route('management.index')->with('store_register', "Manager not found");
    }


    // manager update.
    public function update(Request $request, $id) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required',
            'password' => 'nullable|min:8',  // password is optional, min length of 8 if provided
        ]);

        // Find the user by ID
        $manager = User::find($id);

        if ($manager) {
            // Update the name, email, and role
            $manager->name = $request->name;
            $manager->email = $request->email;
            $manager->role = $request->role;

            // Update the password only if provided
            if ($request->password) {
                $manager->password = bcrypt($request->password);  // Ensure password is hashed
            }

            // Save the updated user data
            $manager->save();

            return redirect()->route('management.index', $manager->id)->with('store_register', 'Role & User updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }

//   role session
public function role_index(){

    $bloggers = user::where('role','blogger')->get();
    $users = user::where('role','user')->where('block',false)->get();
    return view('dashboard.management.role.role',[
        'manage' => $users,
        'bloggers' => $bloggers,
    ]);
}
public function role_assing(Request $request){

    $request->validate([
        'role' => 'required|in:manager,blogger,user',
    ]);

    $user = User::where('id',$request->user_id)->first();

    User::find($user->id)->update([
        'role' => $request->role,
        'updated_at' => now(),
    ]);

session()->flash('assignrole','Role Assign Successfull');

    return back();

}

// blogger dwon session.
public function blogger_grade_down($id){
    $user = User::where('id',$id)->first();

    if($user->role == 'blogger'){
        User::find($user->id)->update([
            'role' => 'user',
            'updated_at' => now(),
        ]);
        Session()->flash('assignrole','Role Down Successfull');

        return back();
    }
}


public function user_grade_down($id){
    $user = User::where('id',$id)->first();


    if($user->role == 'user'){
        User::find($user->id)->update([
            'block' => true,
            'updated_at' => now(),
        ]);
        Session()->flash('assignrole','Block This User Successfull');

        return back();
    }
}

// user delete her.
public function user_delete($id,)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return redirect()->route('role_session')->with('assignrole', "user Delete Successful");
    }
    return redirect()->route('role_session')->with('assignrole', "Manager not found");
}

// blogger delete here,
public function  blogger_delete($id){
  $blogger = user::find($id);
  if($blogger){
    $blogger->delete();
    return redirect()->route('role_session')->with('assignrole', "blogger Delete Successful");
}
return redirect()->route('role_session')->with('store_register', "Manager not found");

}
}

