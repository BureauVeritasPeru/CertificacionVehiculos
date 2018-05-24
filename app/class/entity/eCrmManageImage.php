<?php
	/**
	 * Object represents table 'crm_manage'
	 *
     	 * @author: Junior Huallullo	
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmManageImage{
		
		public $photoID;
		public $fotoID;
		public $precertID;
		public $archivo;
		public $fechaRegistro;
		
		
		public function __construct($photoID=NULL, $fotoID=NULL,$precertID=NULL, $archivo=NULL, $fechaRegistro=NULL)
		{
			$this->photoID 						= $photoID;
			$this->fotoID 						= $fotoID;
			$this->precertID 					= $precertID;
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













