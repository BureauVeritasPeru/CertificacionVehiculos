<?php
	/**
	 * Object represents table 'glp_precertificado'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGlpPrecertificado{
		
		public $precertID;
		public $tipocertID;
		public $placa;
		public $marcaID;
		public $modeloID;
		public $categoriaID;
		public $combustibleID;
		public $version;
		public $ano_fab;
		public $serie;
		public $vin;
		public $motor;
		public $cilindros;
		public $cilindrada;
		public $ejes;
		public $ruedas;
		public $asientos;
		public $pasajeros;
		public $largo;
		public $ancho;
		public $alto;
		public $pesoNeto;
		public $pesoBruto;
		public $cargaUtil;
		public $combustibleMod;
		public $pesoNetoMod;
		public $cargaUtilMod;
		public $fechaCreacion;
		public $usuCreacion;

		public function __construct($precertID=null, $tipocertID=null, $placa=null, $marcaID=null, $modeloID=null, $categoriaID=null, $combustibleID=null, $version=null, $ano_fab=null, $serie=null, $vin=null, $motor=null, $cilindros=null, $cilindrada=null, $ejes=null, $ruedas=null, $asientos=null, $pasajeros=null, $largo=null, $ancho=null, $alto=null, $pesoNeto=null, $pesoBruto=null, $cargaUtil=null, $combustibleMod=null, $pesoNetoMod=null, $cargaUtilMod=null, $fechaCreacion=null, $usuCreacion=null)
		{
			$this->precertID 		= $precertID;
			$this->tipocertID 		= $tipocertID;
			$this->placa 			= $placa;
			$this->marcaID 			= $marcaID;
			$this->modeloID 		= $modeloID;
			$this->categoriaID		= $categoriaID;
			$this->combustibleID	= $combustibleID;
			$this->version			= $version;
			$this->ano_fab			= $ano_fab;
			$this->serie			= $serie;
			$this->vin				= $vin;
			$this->motor			= $motor;
			$this->cilindros		= $cilindros;
			$this->cilindrada		= $cilindrada;
			$this->ejes			= $ejes;
			$this->ruedas			= $ruedas;
			$this->asientos		= $asientos;
			$this->pasajeros		= $pasajeros;
			$this->largo			= $largo;
			$this->ancho			= $ancho;
			$this->alto			= $alto;
			$this->pesoNeto		= $pesoNeto;
			$this->pesoBruto		= $pesoBruto;
			$this->cargaUtil		= $cargaUtil;
			$this->combustibleMod	= $combustibleMod;
			$this->pesoNetoMod		= $pesoNetoMod;
			$this->cargaUtilMod	= $cargaUtilMod;
			$this->fechaCreacion	= $fechaCreacion;
			$this->usuCreacion		= $usuCreacion;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
?>