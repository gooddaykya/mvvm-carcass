<?php
	namespace Blog\FrontController\FFC;

	class FullRequests implements \Blog\Interfaces\RequestsAdapter
	{
		private $routes;
		private $separator;


		public function __construct()
		{
			$this->routes = array(
				'^articles/([0-9]+)$' => 'PDOBase/Article/ViewOne/Article/html/setData/$1',
				'^articles(.*)$'      => 'PDOBase/Article/ViewOne/Article/html/setData/1',

				'^topics(.*)$' => 'PDOBase/Article/ViewList/Topics/html/null/',
				 
				'^(.*)$' => 'PDOBase/Article/ViewList/Topics/html/null/',
				);
			$this->separator = '/';
		}


		public function getSeparator()
		{
			return $this->separator;
		}


		public function getRequests()
		{
			return $this->routes;
		}
	}
