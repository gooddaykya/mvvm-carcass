<?php
	namespace Blog\Components\DiC;
	
	class Analyzer
	{
		private $class;
		
		public function __construct($class)
		{
			if (empty($class))
				throw new \Exception('DiC analyzer: missing class' . PHP_EOL);
			else
				$this->class = $class;
		}

		
		public function getDependencies()
		{
			$dependencies = array();

			$object = new \ReflectionClass($this->class);
			$constructor = $object->getConstructor();
			
			if ($constructor != null) {

				foreach ($constructor->getParameters() as $dep)
					$dependencies[] = $dep->getClass()->getName();
			}
			
			return $dependencies;
		}
	}

