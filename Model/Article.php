<?php
	namespace Blog\Model;

	class Article extends ParentModel
	{
		public function __construct(\Blog\Interfaces\DatabaseAdapter $adapter)
		{
			parent::__construct($adapter);
			$this->db->connect();
		}


		public function __destruct()
		{
			$this->db->disconnect();
		}


		public function getOne()
		{
			$request     = 'SELECT * FROM articles WHERE aid =:id';
			$bindParams  = array(
				':id'    => $this->current,
				);
			$requestType = 'selectOne';
			$this->db->connect();
			$result = $this->db->getQuery($request, $bindParams, $requestType);
			return ($result) ? $result : array();
		}


		public function getList()
		{
			$request = 'SELECT title, quots, date FROM articles';
			return $this->db->getQuery($request, array());
		}


		public function countList()
		{
			return count($this->getList());
		}
	}
