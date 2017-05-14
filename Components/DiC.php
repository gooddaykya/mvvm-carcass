<?php
	namespace Blog\Components;

	class DiC
	{
		private $class;
		private $analyzer;

		public function __construct($class)
		{
			$this->class = $class;
			$this->analyzer = new DiC\Analyzer($this->class);
		}


		public function create()
		{
			$dependencies = $this->analyzer->getDependencies();

			if(empty($dependencies)) {
			
				return new $this->class();

			} else {

				foreach ($dependencies as $dep) {

					$obj = new DiC($dep);
					$deps[] = $obj->create();

				}
				$obj = new \ReflectionClass($this->class);
				return $obj->newInstanceArgs($deps);

			}
		}
	}
