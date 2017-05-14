<?php
	namespace Blog\Controllers;

	abstract class ParentController
	{
		protected $model;
		
		abstract public function actionSetData($data);

		public function __construct(\Blog\Interfaces\ViewModelAdapter $adapter)
		{
			if (empty($adapter))
				throw new \Exception('Parent controller: missing ViewModel adapter' . PHP_EOL);
			else
				$this->model = $adapter;
		}
	}
