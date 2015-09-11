<?php namespace App\Http\Controllers;

class ProjectJobController extends Controller {
	public function create()
	{
		return view('project.job.create');
	}

	public function edit()
	{
		return view('project.job.edit');
	}
}
