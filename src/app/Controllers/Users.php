<?php
namespace App\Controllers;
use Core\Renderer;

class Users
{
	public function index()
	{
		Renderer::render('pages/users', 'Users');
	}
}
