<?php
	namespace Blog\ViewModel;

	abstract class ParentViewModel implements \Blog\Interfaces\ViewModelAdapter
	{
		protected $model;

		abstract public function getData();

		public function __construct(\Blog\Interfaces\ModelAdapter $adapter)
		{
			if (empty($adapter))
				throw new \Exception('Parent ViewModel: missing Model adapter' . PHP_EOL);
			else
				$this->model = $adapter;
		}
	}
