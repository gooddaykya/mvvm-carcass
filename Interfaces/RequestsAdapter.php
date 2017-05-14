<?php
	namespace Blog\Interfaces;

	interface RequestsAdapter
	{
		public function __construct();
		public function getRequests();
		public function getSeparator();
	}
