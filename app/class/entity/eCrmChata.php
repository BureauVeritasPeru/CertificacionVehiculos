<?php
	/**
	 * Object represents table 'crm_chata'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmChata{
		
		public $chataID;
		public $chiID;
		public $plantaID;
		public $nombrePlanta;
		public $puertoPlanta;
		public $zonaPlanta;
		public $numeroActaDesembarque;
		public $pescaDeclarada;
		public $cierrePuerto;
		public $inspectorID;
		public $nombreInspector;
		public $obsInusual;
		public $fechaRegistro;
		public $pregunta1;
		public $pregunta2;
		public $pregunta3;
		public $pregunta4;
		public $pregunta5;

		public function __construct($chataID=NULL, $chiID=NULL, $plantaID=NULL, $nombrePlanta=NULL, $puertoPlanta=NULL, $zonaPlanta=NULL, $numeroActaDesembarque=NULL, $pescaDeclarada=NULL, $cierrePuerto=NULL, $inspectorID=NULL, $nombreInspector=NULL, $obsInusual=NULL, $fechaRegistro=NULL,$pregunta1=NULL,$pregunta2=NULL,$pregunta3=NULL,$pregunta4=NULL,$pregunta5=NULL)
		{
			$this->chataID 					= $chataID;
			$this->chiID 					= $chiID;
			$this->plantaID 				= $plantaID;
			$this->nombrePlanta 			= $nombrePlanta;
			$this->puertoPlanta 			= $puertoPlanta;
			$this->zonaPlanta 				= $zonaPlanta;
			$this->numeroActaDesembarque 	= $numeroActaDesembarque;
			$this->pescaDeclarada 			= $pescaDeclarada;
			$this->cierrePuerto 			= $cierrePuerto;
			$this->inspectorID 				= $inspectorID;
			$this->nombreInspector 			= $nombreInspector;
			$this->obsInusual 				= $obsInusual;
			$this->fechaRegistro 			= $fechaRegistro;
			$this->pregunta1 				= $pregunta1;
			$this->pregunta2 				= $pregunta2;
			$this->pregunta3 				= $pregunta3;
			$this->pregunta4 				= $pregunta4;
			$this->pregunta5 				= $pregunta5;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>







