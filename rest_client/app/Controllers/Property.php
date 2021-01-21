<?php

namespace App\Controllers;

use App\Libraries\Property as Prop;

class Property extends BaseController
{
	public function __construct()
	{
		$this->property = new Prop();
	}

	public function index()
	{
		$data   = [
			'title' =>  'Tuantanah.com - Tempat cari properti',
			'property'  =>  $this->property->getAllProperty()
		];

		return view('property/index', $data);
	}

	public function detail($slug)
	{
		$property = $this->property->getById($slug);
		if ($property) {
			$detailproperty     = $this->property->getById($slug);
		} else {
			$detailproperty     = "Data lowongan is not found!";
		}

		$data = [
			'title'     =>  'Tuantanah.com - Detail Properti',
			'property_slug' =>  $detailproperty,
			'property'  =>  $this->property->getById($slug)
		];
		return view('property/detail', $data);
	}
}
