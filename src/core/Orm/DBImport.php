<?php
namespace Core\Orm;
use Core\Orm\Interfaces\IDBImport;
use PDO;

# INSERT INTO `users` (`id`, `name`, `age`, `email`) VALUES (NULL, 'Kate', '20', 'test2@example.com');
class DBImport implements IDBImport
{
	private DBConnector $connector;
	public function __construct()
	{
		$this->connector = new DBConnector();
	}
	public function import(string $table, array $data): void
	{
		$query = "INSERT INTO ";
		$query .= $table;
		$query .= " (";
		$query .= implode(", ", array_keys($data));
		$query .= ") VALUES (";
		$query .= implode(", ", array_fill(0, count($data), "?"));
		$dbh = $this->connector->connect();
		$sth = $dbh->prepare($query);
		$sth->execute();
		$sth->fetchAll(PDO::FETCH_ASSOC);
	}
}
