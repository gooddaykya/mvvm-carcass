<?php
	namespace Blog\Interfaces;

	interface ViewModelAdapter
	{
		public function __construct(\Blog\Interfaces\ModelAdapter $adapter);
		public function getData();
		public function fetchData($data);
	}
