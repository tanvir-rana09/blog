<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = blog::latest()->paginate(5);
        return view('fontend.blog.index',compact('blogs'));
    }

    public function single($slug){
        $blog = Blog::where('slug',$slug)->first();
        return view('fontend.blog.single',compact('blog'));
    }
}
