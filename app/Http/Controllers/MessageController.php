<?php namespace App\Http\Controllers;

class MessageController extends Controller
{
    public function index()
    {
        // return view('message.index');
        return redirect('/projects');
    }
}
