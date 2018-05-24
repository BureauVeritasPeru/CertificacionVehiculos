<?php
	/**
	 * Object represents table 'crm_facturacion_det'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmFacturacionDet{
		
		public $facturacionDetID;
		public $facturacionID;
		public $tipoServicio;
		public $tipoCertificadoID;
		public $certificadoID;
		public $fechaEmision;
		public $placa;
		public $vin;
		public $motor;
		public $estado;
		public $costo;

		
		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>


