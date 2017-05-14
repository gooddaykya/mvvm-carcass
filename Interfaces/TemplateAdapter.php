<?php
	namespace Blog\Interfaces;

	interface TemplateAdapter
	{
		public function __construct();
		public function getPath();
		public function setPath($path = DEFAULT_PATH);
		public function getLayout();
		public function setLayout($layout = DEFAULT_LAYOUT);
		public function getExtention();
		public function setExtention($ext = DEFAULT_EXTENTION);
		public function generateOutput(array $data = array());
	}

