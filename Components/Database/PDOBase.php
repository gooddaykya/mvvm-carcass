<?php
	namespace Blog\Components\Database;

	class PDOBase implements \Blog\Interfaces\DatabaseAdapter
	{
		private $db;
		private $host;
		private $user;
		private $pass;
		private $base;
		private $char;

		public function __construct(\Blog\Configuration\Requisites $requisites)
		{
			if ($requisites === null)
				throw new \Exception('No requisites received'. PHP_EOL);

			$this->host = $requisites->getHost();
			$this->user = $requisites->getUser();
			$this->pass = $requisites->getPass();
			$this->base = $requisites->getBase();
			$this->char = $requisites->getChar();
		}


		public function connect()
		{
			$dsn = 	'mysql:host=' .$this->host.
					';dbname='    .$this->base.
					';charset='   .$this->char;
			$this->db = new \PDO($dsn, $this->user, $this->pass);
		}


		public function getQuery($request, array $bindParams = array(), $requestType = null)
		{
			try {
					
				$stmt = $this->db->prepare($request);
				foreach ($bindParams as $placeholder => $value)
					$stmt->bindValue($placeholder, $value);
				$stmt->execute();
				switch ($requestType) {
					case 'insert':
					case 'update':
					case 'delete':
						$result = $stmt->rowCount();
						break;
					case 'selectOne':
						$result = $stmt->fetch(\PDO::FETCH_ASSOC);
						break;
					default:
						$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				}
			} catch (\Exception $e) {

				echo $e->getMessage();

			}

			return $result;
		}


		public function disconnect()
		{
			unset($this->db);
		}
	}
