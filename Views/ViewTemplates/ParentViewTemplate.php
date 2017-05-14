<?php
	namespace Blog\Views\ViewTemplates;

	abstract class ParentViewTemplate implements \Blog\Interfaces\ViewTemplateAdapter
	{
		protected $adapter;
		protected $template;

		public function __construct(\Blog\Interfaces\ViewModelAdapter $adapter,
									\Blog\Interfaces\TemplateAdapter  $template)
		{
			if (empty($adapter))
				throw new \Exception('Parent Viewtemplate: missing Model adapter' . PHP_EOL);
			else
				$this->model = $adapter;

			if (empty($template))
				throw new \Exception('Parent Viewtemplate: missing Template adapter'. PHP_EOL);
			else
				$this->template = $template;
		}


		public function renderOutput()
		{
			try {
				$data = $this->model->getData();
				$data = $this->model->fetchData($data);

				try {

					$this->setupLayout();
					$html = $this->template->generateOutput($data);

					echo $html;

				} catch (\Exception $e) {

					echo $e->getMessage();

				}

			} catch (\Exception $e) {

				echo $e->getMessage();

			}
		}
	}
