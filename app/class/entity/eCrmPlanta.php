<?php
	/**
	 * Object represents table 'crm_planta'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmPlanta{
		
		public $plantaID;
		public $codigoPlanta;
		public $nombrePlanta;
		public $puertoPlanta;
		public $zonaPlanta;
		public $regionPlanta;
		public $state;

		public function __construct($plantaID=NULL, $codigoPlanta=NULL, $nombrePlanta=NULL, $puertoPlanta=NULL, $zonaPlanta=NULL, $regionPlanta=NULL, $state=NULL)
		{
			$this->plantaID 		= $plantaID;
			$this->codigoPlanta 	= $codigoPlanta;
			$this->nombrePlanta 	= $nombrePlanta;
			$this->puertoPlanta		= $puertoPlanta;
			$this->zonaPlanta		= $zonaPlanta;
			$this->regionPlanta		= $regionPlanta;
			$this->state		= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
?>