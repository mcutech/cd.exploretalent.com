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

	public function submissions($projectId, $roleId)
	{
		return view('project.role.submissions', ['projectId' => $projectId, 'roleId' => $roleId]);
	}

	public function findtalents($projectId, $roleId)
	{
		return view('project.role.find-talents', ['projectId' => $projectId, 'roleId' => $roleId ]);
	}

	public function likeitlist($projectId, $roleId)
	{
		return view('project.role.likeitlist.index', ['projectId' => $projectId, 'roleId' => $roleId]);
	}

	public function publiclikeitlist()
	{
		return view('project.role.likeitlist.public');
	}

	public function worksheet($projectId, $roleId)
	{
		return view('project.role.worksheet.show', ['projectId' => $projectId, 'roleId' => $roleId]);
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
