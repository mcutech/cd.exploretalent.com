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

	public function selfsubmissions($projectId, $roleId)
	{
		return view('project.role.selfsubmission.index', ['projectId' => $projectId, 'roleId' => $roleId]);
	}

	public function likeitlist($projectId, $roleId)
	{
		return view('project.role.likeitlist.index', ['projectId' => $projectId, 'roleId' => $roleId]);
	}
	public function publiclikeitlist()
	{
		return view('project.role.likeitlist.public');
	}
	public function matches($projectId, $roleId)
	{
		return view('project.role.match.index', ['projectId' => $projectId, 'roleId' => $roleId]);
	}
	public function auditionworksheet()
	{
		return view('project.role.auditionworksheet.index');
	}
	public function callbacks()
	{
		return view('project.role.callbacks');
	}
	public function booked()
	{
		return view('project.role.booked');
	}
}
