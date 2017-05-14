<?php
	namespace Blog\ViewModel;

	class ViewOne extends ParentViewModel
	{
		public function getData()
		{
			return $this->model->getOne();
		}


		public function setCurrent($data)
		{
			$this->model->setCurrent($data);
		}


		public function fetchData($data)
		{
			return $data;
		}
	}
