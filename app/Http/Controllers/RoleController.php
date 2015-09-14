<?php namespace App\Http\Controllers;

class RoleController extends Controller {
	public function create()
	{
		return view('project.role.create');
	}

	public function edit()
	{
		return view('project.role.edit');
	}

	public function selfsubmissions()
	{
		return view('project.role.selfsubmission.index');
	}

	public function likeitlist()
	{
		return view('project.role.likeitlist.index');
	}

	public function matches()
	{
		return view('project.role.match.index');
	}
}
