<?php namespace App\Http\Controllers;

class WorksheetController extends Controller {
	public function index()
	{
		return view('worksheet.index');
	}

	public function show()
	{
		return view('worksheet.show');
	}
}
