<?php
	namespace Blog\Interfaces;

	interface ViewTemplateAdapter
	{
		public function __construct(ViewModelAdapter $adapter, TemplateAdapter $template);
		public function setupLayout();
		public function renderOutput();
	}
