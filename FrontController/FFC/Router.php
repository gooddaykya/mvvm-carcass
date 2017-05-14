<?php
	namespace Blog\FrontController\FFC;

	class Router
	{
		private $uri;
		private $Routes;
		private $DiC;

		public function __construct($uri = null)
		{
			$this->uri = (empty($uri)) ? trim($_SERVER['REQUEST_URI'], '/') : $uri;

			try {

				$this->Routes = new Routes(new FullRequests());

			} catch (\Exception $e) {

				echo $e->getMessage();

			}

			try {

				$this->DiC = new DiC();

			} catch (\Exception $e) {

				echo $e->getMessage();

			}
		}

	
		public function run()
		{

			$request   = $this->Routes->matchRequest($this->uri);

			$converted = $this->Routes->convertRequest($request);
			
			$action    = $converted['action'];
			$params    = $converted['params'];

			$diadNames = array(
				'controller'   => $converted['controller'],
				'viewTemplate' => $converted['viewTemplate'],
				);

			$ruleViewModel = array(
				'instance' => $this->Routes->getNamespace('viewModel') . $converted['viewModel'],
				'shared'   => true,
				);
			
			$ruleDatabase  = array(
				'instance' => $this->Routes->getNamespace('database') . $converted['database'],
				'shared'   => true,
				);
			$ruleModel     = array('instance' => $this->Routes->getNamespace('model') . $converted['model']);
			$this->DiC->addRule(ltrim($this->Routes->getNamespace('interface'), '\\') . 'ModelAdapter', $ruleModel);
			
			$this->DiC->addRule(ltrim($this->Routes->getNamespace('interface'), '\\') . 'ViewModelAdapter', $ruleViewModel);
			$this->DiC->addRule(ltrim($this->Routes->getNamespace('interface'), '\\') . 'DatabaseAdapter',  $ruleDatabase);	
			
			foreach ($diadNames as $type => $name)
				$diad["$type"] = $this->DiC->create($this->Routes->getNamespace($type) . $name);

			if (method_exists($diad['controller'], $action)) {

				$result = call_user_func_array(array(
								$diad['controller'], $action),
								$params
								);

			}
			
			$diad['viewTemplate']->renderOutput();
		}
	}
