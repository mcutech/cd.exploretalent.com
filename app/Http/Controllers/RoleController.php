<?php namespace App\Http\Controllers;

class RoleController extends Controller {
	public function create()
	{
		return view('project.role.create');
	}

	public function edit($projectId, $roleId)
	{
		return view('project.role.edit', ['projectId' => $projectId, 'roleId' => $roleId]);
	}

	public function selfsubmissions()
	{
		return view('project.role.selfsubmission.index');
	}

	public function likeitlist()
	{
		return view('project.role.likeitlist.index');
	}
	public function publiclikeitlist()
	{
		return view('project.role.likeitlist.public');
	}
	public function matches()
	{
		return view('project.role.match.index');
	}
	public function auditionworksheet()
	{
		return view('project.role.auditionworksheet.index');
	}	
}
