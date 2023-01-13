<?php
namespace Core\Orm;
use PDO;

class Select extends QueryBuilder
{
	private DBConnector $connector;
	public function __construct()
	{
		parent::__construct();
		$this->connector = new DBConnector();
		$this->setOperation("SELECT");
	}

	private function buildQuery(): void
	{
		$query = $this->getOperation();
		$query .= " ";
		$query .= $this->getFields();
		$query .= " FROM ";
		$query .= $this->getTableName();
		$query .= $this->getJoinConfigString();
		$query .= $this->getGroupBy();
		$query .= $this->getOrderBy();
		$query .= $this->getWhere();
		$query .= $this->getLimitString();
		$this->setQuery($query);
	}

	public function execute(): ?array
	{
		$this->buildQuery();
		$dbh = $this->connector->connect();
		$sth = $dbh->prepare($this->getQuery());
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
}
