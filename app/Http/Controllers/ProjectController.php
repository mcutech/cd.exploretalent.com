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

	public function quickpost()
	{
		return view('project.quick-post');
	}

	public function worksheet($projectId)
	{
		return view('project.role.worksheet.index', [ 'projectId' => $projectId ]);
	}
}
