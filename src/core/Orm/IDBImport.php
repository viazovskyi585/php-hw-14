<?php
namespace Core\Orm;
interface IDBImport
{
	public function import(string $table, array $data): void;
}
