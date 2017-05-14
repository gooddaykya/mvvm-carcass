<?php
	namespace Blog\Views\ViewTemplates;

	const DEFAULT_PATH = \Blog\ROOT . '/Layouts';
	const DEFAULT_LAYOUT = 'Topics';
	const DEFAULT_EXT = '.html';
	
	class TopicsView extends ParentViewTemplate
	{
		public function setupLayout()
		{
			if (empty($this->template)) {
			
				throw new \Exception('Topics view: missing template adapter' . PHP_EOL);
			
			} else {

				$this->template->setPath(DEFAULT_PATH);
				$this->template->setLayout(DEFAULT_LAYOUT);
				$this->template->setExtention(DEFAULT_EXT);
			}
		}
	}
