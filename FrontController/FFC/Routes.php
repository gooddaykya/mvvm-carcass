<?php
	namespace Blog\FrontController\FFC;

	class Routes implements \Blog\Interfaces\RoutesAdapter
	{
		private $Requests;
		private $namespaces;

		public function __construct(\Blog\Interfaces\RequestsAdapter $requests)
		{
			if (empty($requests))
				throw new \Exception('FFC Routes: missing requests object' .
									 PHP_EOL);
			$this->Requests = $requests;


			$this->namespaces = array(
				'component'     => '\Blog\Components\\',
				'database'      => '\Blog\Components\Database\\',
				'interface'     => '\Blog\Interfaces\\',
				'configuration' => '\Blog\Configuration\\',
				'model'         => '\Blog\Model\\',
				'viewModel'     => '\Blog\ViewModel\\',
				'viewTemplate'  => '\Blog\Views\ViewTemplates\\',
				'template'      => '\Blog\Templates\\',
				'controller'    => '\Blog\Controllers\\',
				);
				
		}


		public function matchRequest($request)
		{
			foreach ($this->Requests->getRequests() as $route => $req) {

				if (preg_match("~$route~", $request))
					return preg_replace("~$route~", $req, $request);

			}

			return false;
		}


		public function convertRequest($request, $sep = null)
		{
			$separator = (empty($sep)) ? $this->Requests->getSeparator() : $sep;
			$request   = explode($separator, $request);

			$db           = array_shift($request);
			$model        = ucfirst(array_shift($request));
			$viewModel    = array_shift($request);
			$viewTemplate = ucfirst(array_shift($request)) . 'View';
			$template     = strtoupper(array_shift($request)) . 'Template';
			$controller   = $model . 'Controller';
			$action       = 'action' . ucfirst(array_shift($request));
			$params       = $request;

			return array(
				'database'     => $db,
				'model'        => $model,
				'viewModel'    => $viewModel,
				'viewTemplate' => $viewTemplate,
				'template'     => $template,
				'controller'   => $controller,
				'action'       => $action,
				'params'       => $params,
				);
		}


		public function getNamespace($component)
		{
			if (isset($this->namespaces["$component"]))
				return $this->namespaces["$component"];
			else
				throw new \Exception('Routes: undefined component' . PHP_EOL);
		}
	}

