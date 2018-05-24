<?php
	/**
	 * Object represents table 'crm_reportes'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmReportes{
		
		public $formatoID;
		public $calcomaniaID;
		public $certificadoID;
		public $userID;
		public $tipoServicioID;
		public $razonSocial;
		public $sede;
		public $placa;
		public $fechaEmi;
		public $tipo;
		public $ano_fab;
		public $costo;
		public $usuario;
		public $vin;
		public $motor;
		public $estado;
		public $tipoServicio;
		public $tipoCertificado;
		public $tipoCertificadoID;

		public $fechaIni;
		public $fechaFin;
		public $usuarioID;



		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>


