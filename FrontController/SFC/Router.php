<?php
	namespace Blog\FrontController\SFC;
	
	const NAMESPACES = array(
		'component'    => '\Blog\Components\\',
		'database'     => '\Blog\Components\Database\\',
		'interface'    => '\Blog\Interfaces\\',
		'model'        => '\Blog\Model\\',
		'viewModel'    => '\Blog\ViewModel\\',
		'view'         => '\Blog\Views\\',
		'viewTemplate' => '\Blog\Views\ViewTemplates\\',
		'template'     => '\Blog\Templates\\',
		'controller'   => '\Blog\Controllers\\',
		);


	class Router
	{
		private $uri;
		private $Routes;
		private $DiC;
		private $Rules;

		public function __construct($uri = null)
		{
			$this->uri = $uri ?? trim($_SERVER['REQUEST_URI'], '/');

			try {

				$this->Routes = new Routes(new SmartRequests());

			} catch (\Exception $e) {

				echo $e->getMessage();

			}
		}


		public function generateRule(string $layer, string $value)
		{
			$Rule = new DiC\Rule($value);
			$Rule->setInstance(NAMESPACES["$layer"] . $value);
			if ($layer === 'viewModel')
				$Rule->setShared();
			$this->Rules[NAMESPACES['interface'] . ucfirst($layer) . 'Adapter'] = $Rule;
		}


		public function run()
		{
			$diad      = array();
			$diadObj   = array();
			$request   = $this->Routes->matchRequest($this->uri);
			$converted = $this->Routes->convertRequest($request);

			if (!empty($converted['viewModel'])) {

				$diad[] = NAMESPACES['interface'] . 'ViewTemplateAdapter';
				$diad[] = NAMESPACES['interface'] . 'ViewModelAdapter';

			}

			if (!empty($converted['controller'])) {

				$params = array_pop($converted);
				$action = array_pop($converted);
				$diad[] = NAMESPACES['interface'] . 'ControllerAdapter';

			}

			foreach ($converted as $layer => $value)
				$this->generateRule($layer, $value);


			try {

				$Analyzer  = new DiC\Analyzer();
				$this->DiC = new DiC($Analyzer, $this->Rules);

				foreach ($diad as $className)
					$diadObj[] = $this->DiC->create($className);
			
			} catch (\Exception $e) {

				echo $e->getMessage();

			}

			if (isset($diadObj[2]))
				$diadObj[2]->$action($params);
			$diadObj[0]->renderOutput();
		}
	}
