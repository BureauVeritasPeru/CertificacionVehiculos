<?php
	/**
	 * Object represents table 'crm_manage'
	 *
     	 * @author: Junior Huallullo	
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmManagePhoto{
		
		public $photoID;
		public $documentoID;
		public $certificadoID;
		public $archivo;
		public $fechaRegistro;
		
		
		public function __construct($photoID=NULL, $documentoID=NULL,$certificadoID=NULL, $archivo=NULL, $fechaRegistro=NULL)
		{
			$this->photoID 						= $photoID;
			$this->documentoID 					= $documentoID;
			$this->certificadoID 				= $certificadoID;
			$this->archivo 						= $archivo;
			$this->fechaRegistro				= $fechaRegistro;
			return $this;	
		}
		

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>













