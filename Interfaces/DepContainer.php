<?php
	namespace Blog\Interfaces;

	interface DepContainer
	{
		public function __construct(AnalyzeAdapter $analyer = null);
		public function create(array $classNames);
	}
