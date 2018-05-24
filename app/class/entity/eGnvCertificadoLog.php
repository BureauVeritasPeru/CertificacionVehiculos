<?php
	/**
	 * Object represents table 'gnv_certificado_log'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGnvCertificadoLog{
		
		public $ID;
		public $certificadoID;
		public $placa;
		public $fechaCambio;
		public $oldFormato;
		public $newFormato;
		public $usuarioID;
		public $motivo;

		public function __construct($ID=null, $certificadoID=null, $placa=null, $fechaCambio=null, $oldFormato=null, $newFormato=null, $usuarioID=null, $motivo=null)
		{
			$this->ID 				= $ID;
			$this->certificadoID 	= $certificadoID;
			$this->placa 			= $placa;
			$this->fechaCambio 		= $fechaCambio;
			$this->oldFormato 		= $oldFormato;
			$this->newFormato 		= $newFormato;
			$this->usuarioID		= $usuarioID;
			$this->motivo			= $motivo;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>