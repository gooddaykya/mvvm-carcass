<?php
	namespace Blog\Templates;

	const DEFAULT_LAYOUT = 'Article';
	const DEFAULT_PATH   = \Blog\ROOT.'/Layouts/';
	const DEFAULT_EXTENTION = '.html';

	class HTMLTemplate implements \Blog\Interfaces\TemplateAdapter
	{
		private $path;
		private $layout;
		private $ext;

		public function __construct()
		{
			$this->path   = DEFAULT_PATH;
			$this->ext    = DEFAULT_EXTENTION;
			$this->layout = DEFAULT_LAYOUT . 'Layout' . $this->ext;
		}


		public function getPath()
		{
			return $this->path;
		}


		public function setPath($path = DEFAULT_PATH)
		{
			$this->path = $path;
		}


		public function getLayout()
		{
			return $this->layout;
		}


		public function setLayout($layout = DEFAULT_LAYOUT)
		{
			$this->layout = $layout . 'Layout' . $this->ext;
		}


		public function getExtention()
		{
			return $this->ext;
		}


		public function setExtention($ext = DEFAULT_EXTENTION)
		{
			$this->ext = $ext;
		}


		public function generateOutput(array $data = array())
		{

			$file = $this->path . '/' . $this->layout;
			if (file_exists($file)) {
				
				if (!empty($data))
					extract($data);
				
				ob_start();

				include($file);

				$output = ob_get_clean();
				
				return $output;

			} else {
				
				throw new \Exception('Missing layout '.
									 $this->layout .
									 ' in ' .
									 $this->path .
									 ' directory' . PHP_EOL);

			}
		}
	}
