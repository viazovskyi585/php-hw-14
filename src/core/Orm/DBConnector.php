<?php
namespace Core\Orm;

use Exception;
use PDO;

class DBConnector
{
	private array $config;
	public function __construct() {
		$this->setConfig();
    }
	public function connect(): PDO
	{
		try {
			return new PDO($this->getDsn(), $this->getLogin(), $this->getPassword());
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	private function setConfig(): void
	{
		$global = include __DIR__ . '/../../config/common.php';
		$this->config = $global['DB'];
	}

	private function getLogin(): string
	{
		$login =  !empty($this->config['login']) ? $this->config['login'] : null;

		if (!is_null($login)) {
			return $login;
		}

		throw new Exception("No login provided");
	}

	private function getPassword(): string
	{
		return !empty($this->config['password']) ? $this->config['password'] : '';
	}

	private function getDsn(): string
	{
		$driver = $this->config['driver'] ?? null;
		$host = $this->config['host'] ?? null;
		$db_name = $this->config['db_name'] ?? null;

		if (!is_null($driver) && !is_null($host) && !is_null($db_name)) {
			return "$driver:host=$host;dbname=$db_name";
		}

		throw new Exception("No DSN provided");
	}
}
