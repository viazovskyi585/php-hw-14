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

	public function importMany()
	{
		Renderer::render('pages/import-many', 'Import Many');
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

	public function createMany()
	{
		$input = file_get_contents('php://input');
		$data = json_decode($input, true);
		$users = $data['users'];
		$import = new UsersModel();
		$import->importUsers($users);
		header('Content-Type: application/json');
		echo json_encode(['success' => true]);
	}
}
