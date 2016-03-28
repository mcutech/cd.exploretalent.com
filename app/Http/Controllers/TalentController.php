<?php namespace App\Http\Controllers;

class TalentController extends Controller {
	public function index()
	{
		return view('talent.index');
	}

	public function favorite()
	{
		return view('talent.favorite');
	}

	public function talentresume()
	{
		return view('talent.resume');
	}
}
