<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\Cetegory;
use Illuminate\Http\Request;

class CetegoryBlogController extends Controller
{
    public function show($slug){
        $cetegory = Cetegory::where('slug',$slug)->first();
        $blogs = blog::where('category_id',$cetegory->id)->paginate(1);
        return view('fontend.cetegory.index',compact('cetegory','blogs'));
    }
}
