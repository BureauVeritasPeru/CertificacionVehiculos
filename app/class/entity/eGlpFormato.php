<?php
	/**
	 * Object represents table 'glp_formato'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGlpFormato{
		
		public $formatoID;
		public $userID;
		public $userAdmID;
		public $fechaCreacion;
		public $estado;

		public $nombreCompleto;
		public $nombreCompletoAdm;

		public function __construct($formatoID=null, $userID=null, $userAdmID=null, $fechaCreacion=null, $estado=null)
		{
			$this->formatoID 		= $formatoID;
			$this->userID 			= $userID;
			$this->userAdmID 		= $userAdmID;
			$this->fechaCreacion 	= $fechaCreacion;
			$this->estado 			= $estado;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>