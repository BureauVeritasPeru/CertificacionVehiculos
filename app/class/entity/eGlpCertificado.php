<?php
	/**
	 * Object represents table 'glp_certificado'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGlpCertificado{
		
		public $certificadoID;
		public $usuarioID;
		public $tipoCliente;
		public $clienteID;
		public $precertID;
		public $tallerID;
		public $sedeID;
		public $fechaEmi;
		public $fechaVen;
		public $formatoID;
		public $calcomaniaID;
		public $observaciones;
		public $fechaCrea;
		public $fechaMod;
		public $estado;

		public $placa;
		public $cliente;
		public $usuario;

		public function __construct($certificadoID=null, $usuarioID=null,$tipoCliente=null, $clienteID=null, $precertID=null, $tallerID=null, $sedeID=null, $fechaEmi=null, $fechaVen=null, $formatoID=null, $calcomaniaID=null, $observaciones=null, $fechaCrea=null, $fechaMod=null, $estado=null)
		{
			$this->certificadoID 	= $certificadoID;
			$this->usuarioID 		= $usuarioID;
			$this->tipoCliente 		= $tipoCliente;
			$this->clienteID 		= $clienteID;
			$this->precertID 		= $precertID;
			$this->tallerID 		= $tallerID;
			$this->sedeID 			= $sedeID;
			$this->fechaEmi			= $fechaEmi;
			$this->fechaVen			= $fechaVen;
			$this->formatoID		= $formatoID;
			$this->calcomaniaID		= $calcomaniaID;
			$this->observaciones	= $observaciones;
			$this->fechaCrea		= $fechaCrea;
			$this->fechaMod			= $fechaMod;
			$this->estado			= $estado;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>