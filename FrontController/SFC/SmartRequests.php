<?php
	namespace Blog\FrontController\SFC;

	class SmartRequests implements \Blog\Interfaces\RequestsAdapter
	{
		private $requests;
		private $separator;
		private $innerSeparator;

		public function __construct()
		{
			$this->requests = array(
				'^articles/([0-9]+)$' => 'database-PDOBase/' .
										 'model-Article/' .
										 'viewModel-ViewOne/' .
										 'viewTemplate-ArticleView/' .
										 'template-HTMLTemplate/' .
										 'controller-ArticleController/' .
										 'action-setData/' .
										 'params-$1',

				'^articles(.*)$'      => 'database-PDOBase/' .
										 'model-Article/' .
										 'viewModel-ViewOne/' .
										 'viewTemplate-ArticleView/' .
										 'template-HTMLTemplate/' .
										 'controller-ArticleController/' .
										 'action-setData/' .
										 'params-1',

				'^topics(.*)$' =>	'database-PDOBase/' .
									'model-Article/' .
									'viewModel-ViewList/' .
									'viewTemplate-TopicsView/' .
									'template-HTMLTemplate',
				
				'^(.*)$' =>	'database-PDOBase/' .
							'model-Article/' .
							'viewModel-ViewList/' .
							'viewTemplate-TopicsView/' .
							'template-HTMLTemplate',
				);

			$this->separator      = '/';
			$this->innerSeparator = '-';
		}


		public function getSeparator()
		{
			return $this->separator;
		}


		public function getInnerSeparator()
		{
			return $this->innerSeparator;
		}


		public function getRequests()
		{
			return $this->requests;
		}
	}
