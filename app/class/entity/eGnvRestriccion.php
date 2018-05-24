<?php
	/**
	 * Object represents table 'gnv_restriccion'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGnvRestriccion{
		
		public $restriccionID;
		public $precertID;
		public $placaRest;
		public $observacionesRest;
		public $registerDate;
		

		public function __construct($restriccionID=null, $precertID=null,$placaRest=null, $observacionesRest=null, $registerDate=null)
		{
			$this->restriccionID 		= $restriccionID;
			$this->precertID 			= $precertID;
			$this->placaRest 			= $placaRest;
			$this->observacionesRest 	= $observacionesRest;
			$this->registerDate 		= $registerDate;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>