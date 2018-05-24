<?php
	/**
	 * Object represents table 'gnv_calcomania'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGnvCalcomania{
		
		public $calcomaniaID;
		public $userID;
		public $userAdmID;
		public $fechaCreacion;
		public $estado;

		public $nombreCompleto;
		public $nombreCompletoAdm;

		public function __construct($calcomaniaID=null, $userID=null, $userAdmID=null, $fechaCreacion=null, $estado=null)
		{
			$this->calcomaniaID 		= $calcomaniaID;
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