<?php
	/**
	 * Object represents table 'crm_placa_restriccion'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmRestriccionPlaca{
		
		public $restriccionID;
		public $placa;
		public $observaciones;
		public $state;
		public $registerDate;

		public function __construct($restriccionID=null, $placa=null,$observaciones=null, $state=null, $registerDate=null)
		{
			$this->restriccionID 	= $restriccionID;
			$this->placa 		= $placa;
			$this->observaciones 		= $observaciones;
			$this->state 		= $state;
			$this->registerDate 		= $registerDate;

			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>