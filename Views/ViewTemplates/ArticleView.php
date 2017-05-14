<?php
	namespace Blog\Views\ViewTemplates;

	const DEFAULT_PATH = \Blog\ROOT . '/Layouts';
	const DEFAULT_NAME = 'Article';
	const DEFAULT_EXT  = '.html';

	class ArticleView extends ParentViewTemplate
	{
		public function setupLayout()
		{
			$this->template->setPath(DEFAULT_PATH);
			$this->template->setLayout(DEFAULT_NAME);
			$this->template->setExtention(DEFAULT_EXT);
		}
	}
