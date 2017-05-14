<?php
	namespace Blog\FrontController\FFC;

	class DiC
	{
		private $Analyzer;
		private $namespaces;
		private $instances;
		private $rules;

		public function __construct()
		{
			$this->Analyzer = new Analyzer();
			
			/**/
			$this->namespaces = array(
				'other'        => '\Blog\\',
				'interface'    => '\Blog\Interfaces\\',
				'database'     => '\Blog\Components\Database\\',
				'model'        => '\Blog\Model\\',
				'viewModel'    => '\Blog\ViewModel\\',
				'viewTemplate' => '\Blog\Views\ViewTemplates\\',
				'template'     => '\Blog\Templates\\',
			 	);
			/**/
			$this->inctances = array();
			$this->rules     = array();
			$this->objects   = array();
		}


		private function setAnalyzer()
		{
			try {
			
			$this->Analyzer = new Analyzer();

			} catch (\Exception $e) {

				echo $e;

			}
		}


		private function getInstance($interface)
		{
			if (empty($this->instances["$interface"])) {

				throw new \Exception('DepCon: missing instance for interface ' .
									 $interface .
									 PHP_EOL);

			} else {

				return $this->instances["$interface"];

			}
		}


		private function setInstance($interface, $instance)
		{
			if (empty($interface) || empty($instance)) {

				throw new \Exception('DepCon: missing interface OR instance' . 
									 PHP_EOL);

			} else {

				$this->instances["$interface"] = $instance;

			}
		}


		private function setRules()
		{
			//$this->instances['DatabaseAdapter'] = $this->namespaces['database'] . 'PDOBase';
			$this->instances['ModelAdapter']    = $this->namespaces['model']    . 'Article';
			//$this->instances['ViewModelAdapter'] = $this->namespaces['viewModel'] . 'ViewOne';
			$this->instances['ViewTemplateAdapter'] = $this->namespaces['viewTemplate'] . 'ArticleView';
			$this->instances['TemplateAdapter'] = $this->namespaces['template'] . 'HTMLTemplate';

		}


		public function addRule($class, $rule)
		{
			$this->rules["$class"] = $rule;
		}


		public function create($class)
		{
			
			$this->setRules();
			$this->setAnalyzer();
			
			if (isset($this->rules["$class"]['shared']) && $this->rules["$class"]['shared'] === true) {
				
				if(!isset($this->objects["$class"])) {

					if ($this->Analyzer->isInterface($class))
						$instance = $this->rules["$class"]['instance'];

					$dependencies = $this->Analyzer->getDependencies($instance);
					if (empty($dependencies)) {

						$this->objects["$class"] = new $class();
					
					} else {

						foreach ($dependencies as $dep)
							$deps[] = $this->create($dep);

						$this->objects["$class"] = new $instance(...$deps);

					}
				}
				
				return $this->objects["$class"];
			
			} else {

				$isInterface = $this->Analyzer->isInterface($class);
				if ($isInterface)
					$class = $this->getInstance($isInterface);
				
				$dependencies = $this->Analyzer->getDependencies($class);
				
				if (empty($dependencies)) {
				
					return new $class;
				
				} else {
				
					foreach ($dependencies as $dep)
						$deps[] = $this->create($dep);

				return new $class(...$deps);
				}
			}
		}
	}
