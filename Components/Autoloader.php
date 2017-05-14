<?php
	namespace Blog\Components;

	class Autoloader
	{
		private $dependency;

		public function __construct($className)
		{
			$this->dependency = $className;
		}


		public function load()
		{
			$depArray  = explode('\\', $this->dependency);

			$className = array_pop($depArray);
			array_shift($depArray); // Removing prime namespace Blog
			$dir       = implode('/', $depArray);
			$file      = $dir . '/' . $className . '.php';
			
			if (file_exists($file)) {
				include_once($file);
				return;
			}

			throw new \Exception('Autoloader: Missing class <i>' .
								 $className. 
								 '</i> in directory <i>/'.
								 $dir . 
								 '</i>' .
								 PHP_EOL);
		}
	}
