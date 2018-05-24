<?php
	/**
	 * Object represents table 'crm_cala'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmCala{
		
		public $calaID;
		public $chiID;
		public $numReporteCala;
		public $codigoFaenaWeb;
		public $fechaRegistro;
		
		public function __construct($calaID=NULL, $chiID=NULL, $numReporteCala=NULL, $codigoFaenaWeb=NULL, $fechaRegistro=NULL)
		{
			$this->calaID				= $calaID;
			$this->chiID				= $chiID;
			$this->numReporteCala		= $numReporteCala;
			$this->codigoFaenaWeb		= $codigoFaenaWeb;
			$this->fechaRegistro		= $fechaRegistro;
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>