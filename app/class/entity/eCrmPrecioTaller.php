<?php
	/**
	 * Object represents table 'crm_sede'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmPrecioTaller{
		
		public $precioID;
		public $tallerID;
		public $tipoServicio;
		public $tipoCertificado;
		public $costo;
		public $fechaRegistro;

		public function __construct($precioID=null, $tallerID=null, $tipoServicio=null, $tipoCertificado=null, $costo=null, $fechaRegistro=null)
		{
			$this->precioID 				= $precioID;
			$this->tallerID 				= $tallerID;
			$this->tipoServicio 			= $tipoServicio;
			$this->tipoCertificado 			= $tipoCertificado;
			$this->costo 					= $costo;
			$this->fechaRegistro 		    = $fechaRegistro;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>