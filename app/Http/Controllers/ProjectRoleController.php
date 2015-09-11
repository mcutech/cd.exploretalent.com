<?php namespace App\Http\Controllers;

class ProjectRoleController extends Controller {
	public function create()
	{
		return view('project.role.create');
	}

	public function edit()
	{
		return view('project.role.edit');
	}
}
