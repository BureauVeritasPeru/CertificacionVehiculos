<?php
	/**
	 * Object represents table 'ubg_state'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eLink{
		
		public $url;
		public $text;
		public $target;
		public $title;

		public function __construct($url=NULL, $text=NULL, $target=NULL, $title=NULL)
		{
			$this->url 		= $url;
			$this->text 	= $text;
			$this->target 	= $target;
			$this->title	= $title;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
?>