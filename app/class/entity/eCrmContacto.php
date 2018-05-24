<?php
	/**
	 * Object represents table 'crm_contacto'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmContacto{
		
		public $contactoID;
		public $tallerID;
		public $nombreCompleto;
		public $direccion;
		public $telefono;
		public $estado;

		public function __construct($contactoID=null, $tallerID=null, $nombreCompleto=null, $direccion=null, $telefono=null, $estado=null)
		{
			$this->contactoID 			= $contactoID;
			$this->tallerID 			= $tallerID;
			$this->nombreCompleto 		= $nombreCompleto;
			$this->direccion 			= $direccion;
			$this->telefono 			= $telefono;
			$this->estado 				= $estado;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>