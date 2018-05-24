<?php
	/**
	 * Object represents table 'crm_cliente'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmClienteCert{
		
		public $clienteCertID;
		public $precertID;
		public $clienteID;
		public $fechaRegistro;
		public $name;
		public $lastname;
		public $phone;
		public $celular;
		public $numDoc;

		public function __construct($clienteCertID=NULL, $precertID=NULL, $clienteID=NULL, $fechaRegistro=NULL)
		{
			$this->clienteCertID 	= $clienteCertID;
			$this->precertID 		= $precertID;
			$this->clienteID		= $clienteID;
			$this->fechaRegistro	= $fechaRegistro;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>