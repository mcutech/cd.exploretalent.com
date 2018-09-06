<?php namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function settings()
    {
        return view('profile.settings');
    }
}
