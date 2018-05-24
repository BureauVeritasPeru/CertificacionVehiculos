<?php
	/**
	 * Object represents table 'crm_empleado'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-08-16 20:00	 
	 */
	class eCrmEmpleadoLog{
		
		public $registroID;
		public $fechaRegistro;
		public $personaID;
		public $moduleID;
		public $contentID;
		public $observacion;

		public $contentTitle;
		public $pageViews;
		public $gerencia;
		public $empleado;

		public function __construct($registroID=null, $fechaRegistro=null, $personaID=null, $moduleID=null, $contentID=null, $observacion=null)
		{
			$this->registroID 		= $registroID;
			$this->fechaRegistro 	= $fechaRegistro;
			$this->personaID 		= $personaID;
			$this->moduleID 		= $moduleID;
			$this->contentID 		= $contentID;
			$this->observacion 		= $observacion;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>