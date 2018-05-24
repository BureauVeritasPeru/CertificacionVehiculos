<?php
	/**
	 * Object represents table 'ubg_state'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCrmUbigeo{
		
		public $cod_dpto;
		public $cod_prov;
		public $cod_dist;
		public $nombre;

		public function __construct($cod_dpto=null, $cod_prov=null, $cod_dist=null, $nombre=null)
		{
			$this->cod_dpto 	= $cod_dpto;
			$this->cod_prov 	= $cod_prov;
			$this->cod_dist 	= $cod_dist;
			$this->nombre		= $nombre;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
?>