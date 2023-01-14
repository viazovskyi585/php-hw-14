<?php
namespace App\Controllers;
use App\Models\Users as UsersModel;
use Core\Renderer;
use Core\TableRenderer;

class Users
{
	public function index()
	{
		$users = UsersModel::getAll();
		TableRenderer::render($users);
	}
}
