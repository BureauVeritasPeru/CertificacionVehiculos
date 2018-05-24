<?php
	/**
	 * Object represents table 'glp_comp_inst'
	 *
     	 * @author: Alexis Sanchez
     	 * @date: 2011-08-16 20:00	 
	 */
	class eGlpCompInst{
		
		public $compInsID;
		public $certificadoID;
		public $tipoCompID;
		public $marca;
		public $modelo;
		public $serie;
		public $capacidad;
		public $mes_fab;
		public $ano_fab;
		public $cilindro;

		public function __construct($compInsID=null, $certificadoID=null, $tipoCompID=null, $marca=null, $modelo=null, $serie=null, $capacidad=null, $mes_fab=null, $ano_fab=null, $cilindro=null)
		{
			$this->compInsID 	= $compInsID;
			$this->certificadoID = $certificadoID;
			$this->tipoCompID 	= $tipoCompID;
			$this->marca 		= $marca;
			$this->modelo 		= $modelo;
			$this->serie		= $serie;
			$this->capacidad	= $capacidad;
			$this->mes_fab		= $mes_fab;
			$this->ano_fab		= $ano_fab;
			$this->cilindro		= $cilindro;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
	}
	?>