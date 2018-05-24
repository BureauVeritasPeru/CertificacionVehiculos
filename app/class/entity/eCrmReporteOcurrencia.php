<?php
	/**
	 * Object represents table 'crm_reporte_ocurrencia'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmReporteOcurrencia{
		
		public $reporteOcurrenciaID;
		public $chiID;
		public $correlativo;
		public $numReporteOcurrencia;
		public $actaDecomiso;
		public $tmDecomisado;
		public $subCodigoNumeroDecomiso;
		public $porcDecomisado;
		public $actaRetencionPago;
		public $infractor;
		public $inspectorID;
		public $nombreInspector;
		

		
		public function __construct($reporteOcurrenciaID=NULL,$chiID=NULL,$correlativo=NULL,$numReporteOcurrencia=NULL,$actaDecomiso=NULL,$tmDecomisado=NULL,$subCodigoNumeroDecomiso=NULL,$porcDecomisado=NULL,$actaRetencionPago=NULL,$infractor=NULL,$inspectorID=NULL,$nombreInspector=NULL)
		{
			$this->reporteOcurrenciaID			=	$reporteOcurrenciaID;
			$this->chiID						=	$chiID;
			$this->correlativo					=	$correlativo;
			$this->numReporteOcurrencia			=	$numReporteOcurrencia;
			$this->actaDecomiso					=	$actaDecomiso;
			$this->tmDecomisado					=	$tmDecomisado;
			$this->subCodigoNumeroDecomiso		=	$subCodigoNumeroDecomiso;
			$this->porcDecomisado				=	$porcDecomisado;
			$this->actaRetencionPago			=	$actaRetencionPago;
			$this->infractor					=	$infractor;
			$this->inspectorID					=	$inspectorID;
			$this->nombreInspector				=	$nombreInspector;
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>



