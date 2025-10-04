<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class HomeController extends Controller
{
    public function home()
    {
        $campaigns = Campaign::get();

        return view('front.home', compact('campaigns'));
    }
}
