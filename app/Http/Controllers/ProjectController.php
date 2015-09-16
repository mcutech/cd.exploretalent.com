<?php namespace App\Http\Controllers;

class ProjectController extends Controller {
	public function index()
	{
		return view('project.index');
	}

	public function show()
	{
		return view('project.show');
	}

	public function create()
	{
		return view('project.create');
	}

	public function edit($projectId)
	{
		return view('project.edit', ['projectId' => $projectId]);
	}
}
