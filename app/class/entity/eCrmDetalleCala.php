<?php
	/**
	 * Object represents table 'crm_detalle_cala'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmDetalleCala{
		
		public $detalleCalaID;
		public $calaID;
		public $correlativo;
		public $latitud;
		public $minLat;
		public $segLat;
		public $longitud;
		public $minLong;
		public $segLong;
		public $fechaCala;
		public $horaCala;
		public $tmDeclaradas;
		public $juveniles;
		public $porcJuveniles;
		public $especie;
		public $porcEspecie;
		public $chiID;

		public function __construct($detalleCalaID=NULL,$calaID=NULL,$correlativo=NULL,$latitud=NULL,$minLat=NULL,$segLat=NULL,$longitud=NULL,$minLong=NULL,$segLong=NULL,$fechaCala=NULL,$horaCala=NULL,$tmDeclaradas=NULL,$juveniles=NULL,$porcJuveniles=NULL,$especie=NULL,$porcEspecie=NULL)
		{
			$this->detalleCalaID	=		$detalleCalaID;
			$this->calaID			=		$calaID;
			$this->correlativo		=		$correlativo;
			$this->latitud			=		$latitud;
			$this->minLat			=		$minLat;
			$this->segLat			=		$segLat;
			$this->longitud			=		$longitud;
			$this->minLong			=		$minLong;
			$this->segLong			=		$segLong;
			$this->fechaCala		=		$fechaCala;
			$this->horaCala			=		$horaCala;
			$this->tmDeclaradas		=		$tmDeclaradas;
			$this->juveniles		=		$juveniles;
			$this->porcJuveniles	=		$porcJuveniles;
			$this->especie			=		$especie;
			$this->porcEspecie		=		$porcEspecie;
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>


	