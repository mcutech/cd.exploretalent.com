<?php namespace App\Http\Controllers;

class AlternateEmailsController extends Controller
{
    public function index()
    {
        return view('profile.alternate-emails');
    }
}
