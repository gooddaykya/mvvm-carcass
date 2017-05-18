<?php
	namespace Blog\FrontController\SFC;

	class Routes implements \Blog\Interfaces\RoutesAdapter
	{
		private $Requests;

		public function __construct(\Blog\Interfaces\RequestsAdapter $requests)
		{
			$this->Requests = $requests;
		}


		public function matchRequest($uri)
		{
			foreach ($this->Requests->getRequests() as $route => $req) {

				if (preg_match("~$route~", $uri))
					return preg_replace("~$route~", $req, $uri);

			}
		}


		public function convertRequest($request, $sep = null, $innerSep = null)
		{
			$convert   = array();

			$separator = $sep      ?? $this->Requests->getSeparator();
			$inner     = $innerSep ?? $this->Requests->getInnerSeparator();

			$request   = explode($separator, $request);

			foreach ($request as $element) {

				$tmp = explode($inner, $element);
				$convert["$tmp[0]"] = $tmp[1];

			}

			return $convert;
		}


		public function getNamespace($component)
		{
		}
	}
