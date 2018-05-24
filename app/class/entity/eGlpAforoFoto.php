<?php
	/**
	 * Object represents table 'glp_aforo_doc'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGlpAforoFoto{
		
		public $certificadoID;
		public $fotoID;

		public function __construct($certificadoID=null, $fotoID=null)
		{
			$this->certificadoID 	= $certificadoID;
			$this->fotoID 		= $fotoID;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>