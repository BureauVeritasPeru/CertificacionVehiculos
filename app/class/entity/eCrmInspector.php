<?php
	/**
	 * Object represents table 'crm_planta'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmInspector{
		
		public $inspectorID;
		public $codigoInspector;
		public $apellidoPaterno;
		public $apellidoMaterno;
		public $nombreInspector;
		public $nroDocumento;
		public $nombreCompletoInspector;
		public $fechaRegistro;
		public $fechaActualizado;
		public $state;

		public function __construct($inspectorID=NULL, $codigoInspector=NULL, $apellidoPaterno=NULL, $apellidoMaterno=NULL, $nombreInspector=NULL, $nroDocumento=NULL, $nombreCompletoInspector=NULL,$fechaRegistro=NULL,$fechaActualizado=NULL,$state=NULL )
		{
			$this->inspectorID 				= $inspectorID;
			$this->codigoInspector 			= $codigoInspector;
			$this->apellidoPaterno 			= $apellidoPaterno;
			$this->apellidoMaterno			= $apellidoMaterno;
			$this->nombreInspector			= $nombreInspector;
			$this->nroDocumento				= $nroDocumento;
			$this->nombreCompletoInspector	= $nombreCompletoInspector;
			$this->fechaRegistro			= $fechaRegistro;
			$this->fechaActualizado			= $fechaActualizado;
			$this->state					= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
?>