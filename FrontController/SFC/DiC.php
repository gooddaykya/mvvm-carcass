<?php
	namespace Blog\FrontController\SFC;

	class DiC
	{
		private $Analyzer;
		private $Rules;
		private $instances;
		private $sharedObj;


		public function __construct($Analyzer, $Rules)
		{
			$this->Rules    = $Rules;
			$this->Analyzer = $Analyzer;
		}


		private function setInstances()
		{
			foreach ($Rules as $Rule)
				$this->instances["$Rule->getName()"] = $Rule->getInstance();
		}


		private function setShared()
		{
			foreach ($Rules as $Rule)
				$this->shared["$Rule->getName()"] = $Rule->getShared();
		}


		public function create($class)
		{
			echo "$class <br/>";
			$Rule = $this->Rules["$class"] ?? null;
			
			if ($this->Analyzer->isInterface($class))
				$class = $Rule->getInstance();

			if (!empty($Rule) && $Rule->getShared() && !empty($this->sharedObj["$class"]))
				return $this->sharedObj["$class"];

			
/**/
			$dependencies = $this->Analyzer->getDependencies($class);
			if (empty($dependencies)) {

				$Obj = new $class();


			} else {

				foreach ($dependencies as $dep)
					$deps[] = $this->create($dep);

				$Obj = new $class(...$deps);

			}
				
			if (true)
				$this->sharedObj["$class"] = $Obj;

			return $this->sharedObj["$class"];
/**/		
		}
	}
