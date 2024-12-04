<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// image update
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }
    // name update session
    public function name_update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'update_at' => now()
        ]);
        return back()->with(['name_update' => "Name update SussesFull.....!!"]);
    }

    // email update session
    public function email_update(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        User::find(Auth::user()->id)->update([
            'email' => $request->email,
            'update_at' => now()
        ]);
        return back()->with(['email_update' => "Email Update SussesFull....!!"]);
    }

    // password update session
    public function password_update(Request $request)
    {
        $request->validate([
            'c_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if (Hash::check($request->c_password, auth()->user()->password)) {
            User::find(Auth::user()->id)->update([
                'password' => $request->password,
                'updated_at' => now(),

            ]);
            return back()->with(['password_update' => " password update SeccesFull...!!"]);
        } else {
            return back()->withErrors(['c_password' => "Current password dosen't match record"]);
        }
    }

    //   iamge update session
    public function image_update(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $newname = auth()->id() . '-' . rand(1111, 9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/update/profile/' . $newname));

            User::find(auth()->id())->update([
                'image' =>$newname,
                'update_at' => now(),

            ]);
            return redirect()->route('profile.index')->with('image_update', "Image update successfull");
        }
    }

 // Method to delete all users
        public function deleteAllUsers($id, Request $request)
        {
            $user = User::where('id',$id)->delete();

            // image delete........................//

            // if($user->image){
            //     $oldpath = base_path('public/update/profile/'.$user->image);

            //     if(file_exists($oldpath)){
            //         unlink($oldpath);
            //     }
            // }
            return redirect()->route('login');
        }
    }

// delete account session
