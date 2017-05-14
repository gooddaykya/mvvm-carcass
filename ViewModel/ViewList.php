<?php
	namespace Blog\ViewModel;

	class ViewList extends ParentViewModel
	{
		public function getData()
		{
			if (empty($this->model))
				throw new \Exception('Viewlist: missing Model adapter');
			else
				return $this->model->getList();
		}


		public function fetchData($data)
		{
			$output = array();

			foreach ($data as $row) {
				foreach ($row as $varName => $varValue)
					$output["$varName"][] = $varValue;
			}

			return $output;
		}
	}
