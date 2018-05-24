<?php
	/**
	 * Object represents table 'crm_tolva'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmTolva{
		
		public $tolvaID;
		public $chiID;
		public $numActaInspeccion;
		public $embarcacionID;
		public $nombreEmbarcacion;
		public $tmDescargado;
		public $capacidadBodega;
		public $excesoBodega;
		public $porcentajeExceso;
		public $ro;
		public $fechaInicial;
		public $horaInicio;
		public $fechaFinal;
		public $horaTermino;
		public $nroReportePesaje;
		public $nroTolva;
		public $inspectorID;
		public $nombreInspector;
		public $pruebaPesaje;
		public $conforme;
		public $numReportePesaje;
		public $horaReportePesaje;
		public $obsInusual;
		public $fechaRegistro;
		public $pregunta6;
		public $pregunta7;
		public $pregunta8;
		public $pregunta9;
		public $pregunta10;




		public function __construct($tolvaID=NULL,$chiID=NULL,$numActaInspeccion=NULL,$embarcacionID=NULL,$nombreEmbarcacion=NULL,$tmDescargado=NULL,$capacidadBodega=NULL,$excesoBodega=NULL,$porcentajeExceso=NULL,$ro=NULL,$fechaInicial=NULL,$horaInicio=NULL,$fechaFinal=NULL,$horaTermino=NULL,$nroReportePesaje=NULL,$nroTolva=NULL,$inspectorID=NULL,$nombreInspector=NULL,$pruebaPesaje=NULL,$conforme=NULL,$numReportePesaje=NULL,$horaReportePesaje=NULL,$obsInusual=NULL,$fechaRegistro=NULL,$pregunta6=NULL,$pregunta7=NULL,$pregunta8=NULL,$pregunta9=NULL,$pregunta10=NULL)
		{
			$this->tolvaID	= $tolvaID;
			$this->chiID	= $chiID;
			$this->numActaInspeccion	= $numActaInspeccion;
			$this->embarcacionID	= $embarcacionID;
			$this->nombreEmbarcacion	= $nombreEmbarcacion;
			$this->tmDescargado	= $tmDescargado;
			$this->capacidadBodega	= $capacidadBodega;
			$this->excesoBodega	= $excesoBodega;
			$this->porcentajeExceso	= $porcentajeExceso;
			$this->ro	= $ro;
			$this->fechaInicial	= $fechaInicial;
			$this->horaInicio	= $horaInicio;
			$this->fechaFinal	= $fechaFinal;
			$this->horaTermino	= $horaTermino;
			$this->nroReportePesaje	= $nroReportePesaje;
			$this->nroTolva	= $nroTolva;
			$this->inspectorID	= $inspectorID;
			$this->nombreInspector	= $nombreInspector;
			$this->pruebaPesaje	= $pruebaPesaje;
			$this->conforme	= $conforme;
			$this->numReportePesaje	= $numReportePesaje;
			$this->horaReportePesaje	= $horaReportePesaje;
			$this->obsInusual	= $obsInusual;
			$this->fechaRegistro	= $fechaRegistro;
			$this->pregunta6 				= $pregunta6;
			$this->pregunta7 				= $pregunta7;
			$this->pregunta8 				= $pregunta8;
			$this->pregunta9 				= $pregunta9;
			$this->pregunta10 				= $pregunta10;

			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>

	