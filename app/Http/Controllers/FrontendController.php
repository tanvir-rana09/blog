<?php

namespace App\Http\Controllers;

use App\Models\Cetegory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $cetegories = Cetegory::where('status', 'active')->latest()->get();
        return view('fontend.home.index',compact('cetegories'));
    }
}
