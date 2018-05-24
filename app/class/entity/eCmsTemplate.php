<?php
	/**
	 * Object represents table 'cms_template'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsTemplate{
		
		public $templateID;
		public $alias;
		public $templateName;
		public $imgIcon;
		public $admSource;
		public $webSource;
		public $comments;
		public $active;

		public function __construct($templateID=null, $alias=null, $templateName=null, $imgIcon=null, $admSource=null, $webSource=null, $comments=null, $active=null)
		{
			$this->templateID 	= $templateID;
			$this->alias 		= $alias;
			$this->templateName = $templateName;
			$this->imgIcon 		= $imgIcon;
			$this->admSource 	= $admSource;
			$this->webSource 	= $webSource;
			$this->comments 	= $comments;
			$this->active		= $active;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>