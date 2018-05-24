<?php
	/**
	 * Object represents table 'crm_infraccion'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmInfraccion{
		
		public $infraccionID;
		public $reporteOcurrenciaID;
		public $correlativo;
		public $codigoInfraccion;
		public $detalleInfraccion;
		public $chiID;
		
		public function __construct($infraccionID=NULL,	$reporteOcurrenciaID=NULL,	$correlativo=NULL,	$codigoInfraccion=NULL,	$detalleInfraccion=NULL)
		{
			$this->infraccionID						= $infraccionID;
			$this->reporteOcurrenciaID				= $reporteOcurrenciaID;
			$this->correlativo						= $correlativo;
			$this->codigoInfraccion					= $codigoInfraccion;
			$this->detalleInfraccion				= $detalleInfraccion;
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>




	
	
	
	
	