<?php
	namespace Blog\Controllers;

	class ArticleController extends ParentController
	{
		public function actionSetData($data)
		{
			if (!is_numeric($data))
				throw new \Exception('Article controller: wrong type of data' . PHP_EOL);

			try {

				$this->model->setCurrent((int) $data);

			} catch (\Exception $e) {

				echo $e->getMessage();

			}
		}
	}
