<?php
namespace App\Models;
use Core\Orm\Select;
use Core\Orm\DBImport;

class Users
{
	public static function getAll()
	{
		$select = new Select();
		$select->setTableName('users');
		$select->setOrderBy(['id' => 'DESC']);
		return $select->execute();
	}

	public function importUser(array $data): void
	{
		$import = new DBImport();
		$import->import("users", $data);
	}

	public function importUsers(array $data): void
	{
		$import = new DBImport();
		$import->importMany("users", $data);
	}
}
