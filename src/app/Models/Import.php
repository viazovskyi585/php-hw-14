<?php
namespace App\Models;
use Core\Orm\DBImport;

class Users
{
	public function importUser(array $data): void
	{
		$import = new DBImport();
		$import->import("users", $data);
	}
}
