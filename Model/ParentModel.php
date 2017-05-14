<?php
	namespace Blog\Model;

	abstract class ParentModel implements \Blog\Interfaces\ModelAdapter
	{
		protected $db;
		protected $current;
		
		
		abstract public function getOne();

		abstract public function getList();
		abstract public function countList();

		public function __construct(\Blog\Interfaces\DatabaseAdapter $adapter = null)
		{
			if ($adapter !== null)
				$this->db = $adapter;

			$this->current = 1;
		}


		public function setCurrent($newValue)
		{
			$this->current = $newValue;
		}
	}
