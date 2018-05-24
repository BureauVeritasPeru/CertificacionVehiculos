<?php
	/**
	 * Object represents table 'crm_cliente'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmClienteJ{
		
		public $clienteID;
		public $razonSocial;
		public $ruc;
		public $representanteLegal;
		public $telefono;
		public $direccion;
		public $email;
		public $fechaRegistro;

		public function __construct($clienteID=NULL, $razonSocial=NULL, $ruc=NULL, $representanteLegal=NULL, $telefono=NULL, $direccion=NULL, $email=NULL, $fechaRegistro=NULL)
		{
			$this->clienteID 		= $clienteID;
			$this->razonSocial 		= $razonSocial;
			$this->ruc				= $ruc;
			$this->representanteLegal 			= $representanteLegal;
			$this->telefono 		= $telefono;
			$this->direccion 		= $direccion;
			$this->email 			= $email;
			$this->fechaRegistro	= $fechaRegistro;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>