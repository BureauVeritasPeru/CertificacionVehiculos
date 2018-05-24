<?php
	/**
	 * Object represents table 'crm_embarcacion'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmEmbarcacion{
		
		public $embarcacionID;
		public $numeralEmbarcacion;
		public $nombreEmbarcacion;
		public $matriculaEmbarcacion;
		public $casco;
		public $regimen;
		public $tipoPreservacion;
		public $eslora;
		public $manga;
		public $puntal;
		public $capbod_m3;
		public $capbod_tm;
		public $resolucion;
		public $permisoPesca;
		public $permisoZarpe;
		public $codigoPago;
		public $transmisor;
		public $armador;
		public $precinto;
		public $aparejo;
		public $especieChi;
		public $especieChd;
		public $pmceNorteCentro;
		public $pmceSur;
		public $nominadaNorteCentro;
		public $nominadaSur;
		public $convenioNorteCentro;
		public $convenioSur;
		public $grupoNorteCentro;
		public $grupoSur;
		public $fechaRegistro;
		public $fechaActualizacion;
		public $state;

		public function __construct($embarcacionID=NULL,$numeralEmbarcacion=NULL,$nombreEmbarcacion=NULL,$matriculaEmbarcacion=NULL,$casco=NULL,$regimen=NULL,$tipoPreservacion=NULL,$eslora=NULL,$manga=NULL,$puntal=NULL,$capbod_m3=NULL,$capbod_tm=NULL,$resolucion=NULL,$permisoPesca=NULL,$permisoZarpe=NULL,$codigoPago=NULL,$transmisor=NULL,$armador=NULL,$precinto=NULL,$aparejo=NULL,$especieChi=NULL,$especieChd=NULL,$pmceNorteCentro=NULL,$pmceSur=NULL,$nominadaNorteCentro=NULL,$nominadaSur=NULL,$convenioNorteCentro=NULL,$convenioSur=NULL,$grupoNorteCentro=NULL,$grupoSur=NULL,$fechaRegistro=NULL,$fechaActualizacion=NULL,$state=NULL)
		{
			$this->embarcacionID        	= $embarcacionID;
			$this->numeralEmbarcacion       = $numeralEmbarcacion;
			$this->nombreEmbarcacion        = $nombreEmbarcacion;
			$this->matriculaEmbarcacion     = $matriculaEmbarcacion;
			$this->casco        			= $casco;
			$this->regimen        			= $regimen;
			$this->tipoPreservacion        	= $tipoPreservacion;
			$this->eslora        			= $eslora;
			$this->manga        			= $manga;
			$this->puntal        			= $puntal;
			$this->capbod_m3        		= $capbod_m3;
			$this->capbod_tm        		= $capbod_tm;
			$this->resolucion        		= $resolucion;
			$this->permisoPesca        		= $permisoPesca;
			$this->permisoZarpe        		= $permisoZarpe;
			$this->codigoPago        		= $codigoPago;
			$this->transmisor        		= $transmisor;
			$this->armador        			= $armador;
			$this->precinto        			= $precinto;
			$this->aparejo        			= $aparejo;
			$this->especieChi        		= $especieChi;
			$this->especieChd        		= $especieChd;
			$this->pmceNorteCentro        	= $pmceNorteCentro;
			$this->pmceSur        			= $pmceSur;
			$this->nominadaNorteCentro      = $nominadaNorteCentro;
			$this->nominadaSur        		= $nominadaSur;
			$this->convenioNorteCentro      = $convenioNorteCentro;
			$this->convenioSur        		= $convenioSur;
			$this->grupoNorteCentro         = $grupoNorteCentro;
			$this->grupoSur        			= $grupoSur;
			$this->fechaRegistro        	= $fechaRegistro;
			$this->fechaActualizacion       = $fechaActualizacion;
			$this->state        			= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>















































	














