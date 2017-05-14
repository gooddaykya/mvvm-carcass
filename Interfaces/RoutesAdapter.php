<?php
	namespace Blog\Interfaces;

	interface RoutesAdapter
	{
		public function __construct(\Blog\Interfaces\RequestsAdapter $requests);
		public function matchRequest($request);
		public function convertRequest($request, $separator = null);
	}
