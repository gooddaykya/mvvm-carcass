<?php
	namespace Blog\Interfaces;

	interface DatabaseAdapter
	{
		public function __construct(\Blog\Configuration\Requisites $requisites);
		public function connect();
		public function getQuery($request, array $bindParams = array(), $requestType = null);
		public function disconnect();
	}
