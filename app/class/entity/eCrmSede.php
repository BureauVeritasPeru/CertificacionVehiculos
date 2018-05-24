<?php
	/**
	 * Object represents table 'crm_sede'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmSede{
		
		public $sedeID;
		public $tallerID;
		public $descripcion;
		public $direccion;
		public $telefono;
		public $ubigeo;
		public $estado;

		public function __construct($sedeID=null, $tallerID=null, $descripcion=null, $direccion=null, $telefono=null, $ubigeo=null, $estado=null)
		{
			$this->sedeID 				= $sedeID;
			$this->tallerID 			= $tallerID;
			$this->descripcion 			= $descripcion;
			$this->direccion 			= $direccion;
			$this->telefono 			= $telefono;
			$this->ubigeo 				= $ubigeo;
			$this->estado 				= $estado;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>