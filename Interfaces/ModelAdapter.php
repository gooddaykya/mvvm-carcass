<?php
	namespace Blog\Interfaces;

	interface ModelAdapter
	{
		public function __construct(\Blog\Interfaces\DatabaseAdapter $adapter);
		public function setCurrent($newValue);
		public function getOne();
		public function getList();
		public function countList();
	}
