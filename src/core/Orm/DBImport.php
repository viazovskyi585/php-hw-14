<?php
namespace Core\Orm;
use Core\Orm\Interfaces\IDBImport;
use PDO;

class DBImport implements IDBImport
{
	private DBConnector $connector;
	public function __construct()
	{
		$this->connector = new DBConnector();
	}

	private function createInsertQuery(string $table, array $data): string
	{
		$query = "INSERT INTO ";
		$query .= $table;
		$query .= " (";
		$query .= implode(", ", array_keys($data));
		$query .= ") VALUES ";
		return $query;
	}

	private function createValuesString(array $data, bool $many = false): string
	{
		if ($many) {
			$values = [];
			foreach ($data as $row) {
				$values[] = "(" . implode(", ", array_fill(0, count($row), "?")) . ")";
			}
			return implode(", ", $values);
		}
		return "(" . implode(", ", array_fill(0, count($data), "?")) . ")";
	}

	public function importMany(string $table, array $data): void
	{
		$query = $this->createInsertQuery($table, $data[0]);
		$query .= $this->createValuesString($data, true);
		$dbh = $this->connector->connect();
		$sth = $dbh->prepare($query);
		$values = [];
		foreach ($data as $row) {
			foreach ($row as $value) {
				$values[] = $value;
			}
		}
		$sth->execute($values);
	}

	public function import(string $table, array $data): void
	{
		$query = $this->createInsertQuery($table, $data);
		$query .= $this->createValuesString($data);
		$dbh = $this->connector->connect();
		$sth = $dbh->prepare($query);
		$sth->execute(array_values($data));
	}
}
