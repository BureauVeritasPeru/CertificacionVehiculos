<?php
	/**
	 * Object represents table 'crm_facturacion'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmFacturacion{
		
		public $facturacionID;
		public $fechaRegistro;
		public $fechaInicio;
		public $fechaFin;
		public $tallerID;
		public $costoTotal;

		public $razonSocial;

		public $facturacionDetID;
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


