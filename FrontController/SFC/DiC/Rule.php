<?php
	namespace Blog\FrontController\SFC\DiC;

	class Rule
	{
		private $name;
		private $instance;
		private $shared = false;


		public function __construct(string $name)
		{
			$this->name = $name;
		}


		public function getName()
		{
			return $this->name;
		}


		public function setInstance(string $instance)
		{
			$this->instance = $instance;
		}


		public function getInstance()
		{
			return $this->instance;
		}


		public function setShared(bool $state = true)
		{
			$this->shared = $state;
		}


		public function getShared()
		{
			return $this->shared;
		}
	}
