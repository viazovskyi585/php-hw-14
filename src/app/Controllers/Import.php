<?php
namespace App\Controllers;
use App\Models\Users as UsersModel;
use Core\Renderer;


class Import
{
	public function index()
	{
		Renderer::render('pages/import', 'Import');
	}

	public function create()
	{
		$data = [
			'name' => $_POST['name'],
			'age' => $_POST['age'],
			'email' => $_POST['email']
		];
		$import = new UsersModel();
		$import->importUser($data);
		Renderer::render('pages/success', 'Success');
	}
}
