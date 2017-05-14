<?php
	namespace Blog\FrontController\FFC;

	class Analyzer
	{
		private $class;

		public function __construct($class = null)
		{
			$this->class = $class;
		}


		public function isInterface($class = null)
		{
			$obj = new \ReflectionClass($class);
			if ($obj->isInterface())
				return $obj->getShortName();
			else
				return false;
		}


		public function getDependencies($class = null)
		{
			$deps = array();

			$obj         = new \ReflectionClass($class);
			$constructor = $obj->getConstructor();

			if (!empty($constructor)) {
				
				foreach ($constructor->getParameters() as $p) 
					$deps[] = $p->getClass()->name;

			}

			return $deps;
		}
	}

