<?php
	/**
	 * Object represents table 'crm_cliente'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmCliente{
		
		public $clienteID;
		public $name;
		public $lastname;
		public $tipoDoc;
		public $numDoc;
		public $fecNac;
		public $sexo;
		public $departamento;
		public $provincia;
		public $distrito;
		public $address;
		public $phone;
		public $celular;
		public $state;

		public function __construct($clienteID=NULL, $name=NULL, $lastname=NULL, $tipoDoc=NULL, $numDoc=NULL, $fecNac=NULL, $sexo=NULL, $departamento=NULL, $provincia=NULL, $distrito=NULL, $address=NULL, $phone=NULL, $celular=NULL, $state=NULL)
		{
			$this->clienteID 	= $clienteID;
			$this->name 		= $name;
			$this->lastname		= $lastname;
			$this->tipoDoc 		= $tipoDoc;
			$this->numDoc 		= $numDoc;
			$this->fecNac 		= $fecNac;
			$this->sexo 		= $sexo;
			$this->departamento = $departamento;
			$this->provincia	= $provincia;
			$this->distrito 	= $distrito;
			$this->address		= $address;
			$this->phone		= $phone;
			$this->celular 		= $celular;
			$this->state		= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>