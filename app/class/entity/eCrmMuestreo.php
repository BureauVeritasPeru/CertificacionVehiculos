<?php
	/**
	 * Object represents table 'crm_muestreo'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmMuestreo{
		
		public $muestreoID;
		public $chiID;
		public $nroParteMuestreo;
		public $especie1ID;
		public $porcEspecie1;
		public $especie2ID;
		public $porcEspecie2;
		public $especie3ID;
		public $porcEspecie3;
		public $especie4ID;
		public $porcEspecie4;
		public $especie5ID;
		public $porcEspecie5;
		public $reporteCala;
		public $estadio;
		public $zonaPesca;
		public $inspectorID;
		public $nombreInspector;
		public $numeroActaMuestreo;
		public $frecuencia8;
		public $frecuencia8_5;
		public $frecuencia9;
		public $frecuencia9_5;
		public $frecuencia10;
		public $frecuencia10_5;
		public $frecuencia11;
		public $frecuencia11_5;
		public $frecuencia12;
		public $frecuencia12_5;
		public $frecuencia13;
		public $frecuencia13_5;
		public $frecuencia14;
		public $frecuencia14_5;
		public $frecuencia15;
		public $frecuencia15_5;
		public $frecuencia16;
		public $frecuencia16_5;
		public $frecuencia17;
		public $frecuencia17_5;
		public $frecuencia18;
		public $totalEjemplares;
		public $moda;
		public $frecuencia;
		public $porcJuveniles;
		public $observaciones;
		public $obsInusual;
		public $fechaRegistro;
		public $pregunta11;
		public $pregunta12;

		public function __construct($muestreoID=NULL,$chiID=NULL,$nroParteMuestreo=NULL,$especie1ID=NULL,$porcEspecie1=NULL,$especie2ID=NULL,$porcEspecie2=NULL,$especie3ID=NULL,$porcEspecie3=NULL,$especie4ID=NULL,$porcEspecie4=NULL,$especie5ID=NULL,$porcEspecie5=NULL,$reporteCala=NULL,$estadio=NULL,$zonaPesca=NULL,$nroTolva=NULL,$inspectorID=NULL,$nombreInspector=NULL,$numeroActaMuestreo=NULL,$frecuencia8=NULL,$frecuencia8_5=NULL,$frecuencia9=NULL,$frecuencia9_5=NULL,$frecuencia10=NULL,$frecuencia10_5=NULL,$frecuencia11=NULL,$frecuencia11_5=NULL,$frecuencia12=NULL,$frecuencia12_5=NULL,$frecuencia13=NULL,$frecuencia13_5=NULL,$frecuencia14=NULL,$frecuencia14_5=NULL,$frecuencia15=NULL,$frecuencia15_5=NULL,$frecuencia16=NULL,$frecuencia16_5=NULL,$frecuencia17=NULL,$frecuencia17_5=NULL,$frecuencia18=NULL,$totalEjemplares=NULL,$moda=NULL,$frecuencia=NULL,$porcJuveniles=NULL,$observaciones=NULL,$obsInusual=NULL,$fechaRegistro=NULL,$pregunta11=NULL,$pregunta12=NULL)
		{
			$this->muestreoID	= $muestreoID;
			$this->chiID		= $chiID;
			$this->nroParteMuestreo = $nroParteMuestreo;
			$this->especie1ID	= $especie1ID;
			$this->porcEspecie1	= $porcEspecie1;
			$this->especie2ID	= $especie2ID;
			$this->porcEspecie2	= $porcEspecie2;
			$this->especie3ID	= $especie3ID;
			$this->porcEspecie3	= $porcEspecie3;
			$this->especie4ID	= $especie4ID;
			$this->porcEspecie4	= $porcEspecie4;
			$this->especie5ID	= $especie5ID;
			$this->porcEspecie5	= $porcEspecie5;
			$this->reporteCala	= $reporteCala;
			$this->estadio	= $estadio;
			$this->zonaPesca	= $zonaPesca;
			$this->nroTolva	= $nroTolva;
			$this->inspectorID	= $inspectorID;
			$this->nombreInspector	= $nombreInspector;
			$this->numeroActaMuestreo	= $numeroActaMuestreo;
			$this->frecuencia8	= $frecuencia8;
			$this->frecuencia8_5	= $frecuencia8_5;
			$this->frecuencia9	= $frecuencia9;
			$this->frecuencia9_5	= $frecuencia9_5;
			$this->frecuencia10	= $frecuencia10;
			$this->frecuencia10_5	= $frecuencia10_5;
			$this->frecuencia11	= $frecuencia11;
			$this->frecuencia11_5	= $frecuencia11_5;
			$this->frecuencia12	= $frecuencia12;
			$this->frecuencia12_5	= $frecuencia12_5;
			$this->frecuencia13	= $frecuencia13;
			$this->frecuencia13_5	= $frecuencia13_5;
			$this->frecuencia14	= $frecuencia14;
			$this->frecuencia14_5	= $frecuencia14_5;
			$this->frecuencia15	= $frecuencia15;
			$this->frecuencia15_5	= $frecuencia15_5;
			$this->frecuencia16	= $frecuencia16;
			$this->frecuencia16_5	= $frecuencia16_5;
			$this->frecuencia17	= $frecuencia17;
			$this->frecuencia17_5	= $frecuencia17_5;
			$this->frecuencia18	= $frecuencia18;
			$this->totalEjemplares 	=	$totalEjemplares;
			$this->moda 	=	$moda;
			$this->frecuencia 	=	$frecuencia;
			$this->porcJuveniles 	=	$porcJuveniles;
			$this->observaciones	= $observaciones;
			$this->obsInusual	= $obsInusual;
			$this->fechaRegistro	= $fechaRegistro;
			$this->pregunta11	= $pregunta11;
			$this->pregunta12	= $pregunta12;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>






