<?php
namespace Core\Orm\Interfaces;
interface IDBImport
{
	public function import(string $table, array $data): void;

	public function importMany(string $table, array $data): void;
}
