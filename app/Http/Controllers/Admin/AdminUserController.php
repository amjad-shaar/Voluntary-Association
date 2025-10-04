<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function volunteers()
    {
        $volunteers = User::where('role', 'volunteer')->get();
        return view('admin.volunteers',compact('volunteers'));
    }

    public function organizers()
    {
        $organizers = User::where('role', 'organizer')->orWhere('role', 'admin')->get();
        return view('admin.organizers',compact('organizers'));
    }
}
