<?php
	/**
	 * Object represents table 'crm_taller'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmTaller{
		
		public $tallerID;
		public $ruc;
		public $razonSocial;
		public $per;
		public $costo;
		public $userID;
		public $fechaCreacion;
		public $glpAut;
		public $gnvAut;
		public $estado;
		public $valid;

		public $nomCompleto;

		public $sedeID;
		public $descripcion;
		public $direccion;
		public $telefono;
		public $ubigeo;
		public $estadoSede;


		public $contactoID;
		public $nombreCompleto;
		public $direccionCont;
		public $telefonoCont;
		public $estadoCont;

		public function __construct($tallerID=null, $ruc=null, $razonSocial=null, $per=null, $costo=null, $userID=null, $fechaCreacion=null, $glpAut=null, $gnvAut=null, $estado=null,$valid=null)
		{
			$this->tallerID 			= $tallerID;
			$this->ruc 					= $ruc;
			$this->razonSocial 			= $razonSocial;
			$this->per					= $per;
			$this->costo				= $costo;
			$this->userID 				= $userID;
			$this->fechaCreacion 		= $fechaCreacion;
			$this->glpAut				= $glpAut;
			$this->gnvAut 				= $gnvAut;
			$this->estado 				= $estado;
			$this->valid 				= $valid;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>