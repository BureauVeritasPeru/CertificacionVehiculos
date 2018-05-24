<?php
	/**
	 * Object represents table 'crm_cliente'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmClienteSP{
		
		public $clienteID;
		public $direccionSP;
		public $emailSP;
		public $celularSP;
		public $fechaRegistro;

		public function __construct($clienteID=NULL, $direccionSP=NULL, $emailSP=NULL, $celularSP=NULL, $fechaRegistro=NULL)
		{
			$this->clienteID 		= $clienteID;
			$this->direccionSP 		= $direccionSP;
			$this->emailSP			= $emailSP;
			$this->celularSP 		= $celularSP;
			$this->fechaRegistro	= $fechaRegistro;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>