<?php

namespace App\Http\Controllers;

use App\Models\Cetegory;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CetegoryController extends Controller
{
    public function index()
    {
        $cetegories = Cetegory::all();
        return view('dashboard.cetegory.index', compact('cetegories'));
    }
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required',
            'image' => 'required|image'
        ]);

        if ($request->hasfile('image')) {
            $newname = auth()->id() . '-' . Str::random(6) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/cetegory/' . $newname));

            if ($request->slug) {
                Cetegory::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->slug, '-'),
                    'image' => $newname,
                    'created_at' => now(),
                ]);

                return back()->with('cat_success', "Category Create Successfull");
            } else {
                Cetegory::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->title, '-'),
                    'image' => $newname,
                    'created_at' => now(),
                ]);
                return back()->with('cat_success', "Category Create Successfull");
            }
        } else {
            return back()->withErrors(['image' => 'image field is must required!'])->withInput();
        }
    }

// edit session here.
public function edit($slug){

    $category = Cetegory::where('slug',$slug)->first();

    return view('dashboard.cetegory.edit',[
        'omar' => $category,
    ]);
}


public function update(Request $request , $slug){
    $category = Cetegory::where('slug',$slug)->first();
    $manager = new ImageManager(new Driver());

    $request->validate([
        'title' => 'required',
    ]);

    if($request->hasFile('image')){

        if($category->image){
            $oldpath = base_path('public/uploads/category/'.$category->image);

            if(file_exists($oldpath)){
                unlink($oldpath);
            }
        }

        $newname = auth()->id().'-'.Str::random(6).'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/uploads/cetegory/'.$newname));

        if($request->slug){
            Cetegory::find($category->id)->update([
                'title' => Str::ucfirst($request->title),
                'slug' => Str::slug($request->slug,'-'),
                'image' => $newname,
                'updated_at' => now(),
            ]);

            return redirect()->route('cetegory.index')->with('cat_success' , "Category Create Successfull");
        }else{
            Cetegory::find($category->id)->update([
                'title' => Str::ucfirst($request->title),
                'slug' => Str::slug($request->title,'-'),
                'image' => $newname,
                'updated_at' => now(),
            ]);
            return redirect()->route('cetegory.index')->with('cat_success' , "Category Create Successfull");
        }

    }else{

        if($request->slug){
            Cetegory::find($category->id)->update([
                'title' => Str::ucfirst($request->title),
                'slug' => Str::slug($request->slug,'-'),
                'updated_at' => now(),
            ]);

            return redirect()->route('cetegory.index')->with('cat_success' , "Category Create Successfull");
        }else{
            Cetegory::find($category->id)->update([
                'title' => Str::ucfirst($request->title),
                'slug' => Str::slug($request->title,'-'),
                'updated_at' => now(),
            ]);
            return redirect()->route('cetegory.index')->with('cat_success' , "Category Create Successfull");
        }

    }


}

// edit session here.

    // delete session start here
    public function destroy($slug)
    {
        $category = Cetegory::where('slug', $slug)->first();

        if ($category->image) {
            $oldpath = base_path('public/uploads/cetegory/' . $category->image);

            if (file_exists($oldpath)) {
                unlink($oldpath);
            }
        }

        Cetegory::find($category->id)->delete();
        return redirect()->route('cetegory.index')->with('cat_success', "Category Delete Successfull");
    }


    // active deactive session
    public function status($id)
    {
        $category = Cetegory::where('id', $id)->first();

        if ($category->status == 'active') {
            Cetegory::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return redirect()->route('cetegory.index')->with('cat_success', "Category Status Change Successfull");
        } else {
            Cetegory::find($category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return redirect()->route('cetegory.index')->with('cat_success', "Category Status Change Successfull");
        }
    }
}
