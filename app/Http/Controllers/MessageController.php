<?php namespace App\Http\Controllers;

class MessageController extends Controller {
	public function settings()
	{
		return view('message.index');
	}
}
