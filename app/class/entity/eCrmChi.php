<?php
	/**
	 * Object represents table 'crm_chi'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmChi{
		
		public $chiID;
		public $userID;
		public $localID;
		public $fechaRegistro;
		public $fechaActualizacion;
		public $estado;
		public $pendiente;
		public $nombrePlanta;
		public $puertoPlanta;
		public $zonaPlanta;
		

		public function __construct($chiID=NULL, $userID=NULL, $localID=NULL, $fechaRegistro=NULL, $fechaActualizacion=NULL, $estado=NULL, $pendiente=NULL)
		{
			$this->chiID				= $chiID;
			$this->userID				= $userID;
			$this->localID				= $localID;
			$this->fechaRegistro		= $fechaRegistro;
			$this->fechaActualizacion	= $fechaActualizacion;
			$this->estado				= $estado;
			$this->pendiente			= $pendiente;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>