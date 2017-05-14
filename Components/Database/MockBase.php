<?php
	namespace Blog\Components\Database;

	class MockBase implements \Blog\Interfaces\DatabaseAdapter
	{
		private $db;
		private $host;
		private $user;

		public function __construct(array $requisites = array())
		{
			if (!empty($requisites)) {

				$this->host = $requisites["hostname"];
				$this->user = $requisites['username'];

			} else {

				$this->host = 'Mockhost';
				$this->user = 'Morkuser';

			}
		}


		public function connect()
		{
			$this->db = new Mockbase(array(
				'hostname' => $this->host,
				'username' => $this->user,
				));
			return $this->db;
		}


		public function getQuery($request, array $bindParams = array(), $requestType = null)
		{
			return array_merge(
				array('title' => 'Executing ' . $request . ' type of '. $requestType),
				$bindParams);
		}


		public function disconnect()
		{
			echo 'Terminating connection' . PHP_EOL;
			unset($this->db);
		}


		public function __destruct()
		{
			echo "Destroyed Mock".PHP_EOL;
		}
	}
