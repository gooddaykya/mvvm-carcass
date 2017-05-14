<?php
	namespace Blog\Configuration;

	class Requisites
	{
		private $host;
		private $user;
		private $pass;
		private $base;
		private $char;
		
		public function __construct()
		{
				$this->host = 'localhost';
				$this->user = 'root';
				$this->pass = '';
				$this->base = 'databaseName';
				$this->char = 'utf8';
		}


		public function getHost()
		{
			return $this->host;
		}


		public function getUser()
		{
			return $this->user;
		}


		public function getPass()
		{
			return $this->pass;
		}


		public function getBase()
		{
			return $this->base;
		}


		public function getChar()
		{
			return $this->char;
		}
	}
