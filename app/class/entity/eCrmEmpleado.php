<?php
	/**
	 * Object represents table 'crm_empleado'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmEmpleado{
		
		public $personaID;
		public $dni;
		public $clave;
		public $nombres;
		public $apellido1;
		public $apellido2;
		public $fechaNacimiento;
		public $posicion;
		public $unidadOrganizativa;
		public $superiorID;
		public $superiorNombre;
		public $gerencia;
		public $email;
		public $estado;
		public $fechaRegistro;


		public function __construct($personaID=null, $dni=null, $clave=null, $nombres=null, $apellido1=null, $apellido2=null, $fechaNacimiento=null, $posicion=null, $unidadOrganizativa=null, $superiorID=null, $superiorNombre=null, $gerencia=null, $email=null, $estado=null, $fechaRegistro=null)
		{
			$this->personaID 			= $personaID;
			$this->dni 					= $dni;
			$this->clave 				= $clave;
			$this->nombres 				= $nombres;
			$this->apellido1 			= $apellido1;
			$this->apellido2 			= $apellido2;
			$this->fechaNacimiento		= $fechaNacimiento;
			$this->posicion 			= $posicion;
			$this->unidadOrganizativa 	= $unidadOrganizativa;
			$this->superiorID 			= $superiorID;
			$this->superiorNombre 		= $superiorNombre;
			$this->gerencia 		= $gerencia;
			$this->email 			= $email;
			$this->estado 			= $estado;
			$this->fechaRegistro 	= $fechaRegistro;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>