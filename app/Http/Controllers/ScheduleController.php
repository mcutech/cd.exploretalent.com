<?php namespace App\Http\Controllers;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('project.schedule.index');
    }

    public function show()
    {
        return view('project.schedule.show');
    }

    public function create()
    {
        return view('project.schedule.create');
    }

    public function edit()
    {
        return view('project.schedule.edit');
    }
}
