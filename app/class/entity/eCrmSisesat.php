<?php
	/**
	 * Object represents table 'crm_sisesat'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmSisesat{
		
		public $sisesatID;
		public $chataID;
		public $tipoSisesat;
		public $horaSisesat;
		public $operatividadSisesat;
		public $contestadoSisesat;
		public $fechaRegistro;
		public $fechaActualizacion;

		public function __construct($sisesatID=NULL, $chataID=NULL, $tipoSisesat=NULL, $horaSisesat=NULL, $operatividadSisesat=NULL, $contestadoSisesat=NULL, $fechaRegistro=NULL,$fechaActualizacion=NULL)
		{
			$this->sisesatID 				= $sisesatID;
			$this->chataID 					= $chataID;
			$this->tipoSisesat 				= $tipoSisesat;
			$this->horaSisesat				= $horaSisesat;
			$this->operatividadSisesat		= $operatividadSisesat;
			$this->contestadoSisesat		= $contestadoSisesat;
			$this->fechaRegistro			= $fechaRegistro;
			$this->fechaActualizacion		= $fechaActualizacion;
			
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
?>