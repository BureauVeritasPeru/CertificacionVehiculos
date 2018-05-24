<?php
	/**
	 * Object represents table 'cms_schema'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsSchema{
		
		public $schemaID;
		public $parentSchemaID;
		public $sectionID;
		public $templateID;
		public $iterations;
		public $position;
		public $publication;
		public $isPage;
		public $active;

		//Aditional parameters to load list
		public $templateName;
		public $imgIcon;
		public $admSource;
		public $webSource;
		public $alias;
		public $comments;
		
		public $childSchema;
		
		public function __construct($schemaID=null, $parentSchemaID=null, $sectionID=null, $templateID=null, $iterations=null, $position=null, $publication=null, $isPage=null, $active=null)
		{
			$this->schemaID 		= $schemaID;
			$this->parentSchemaID 	= $parentSchemaID;
			$this->sectionID 		= $sectionID;
			$this->templateID 		= $templateID;
			$this->iterations 		= $iterations;
			$this->position 		= $position;
			$this->publication 		= $publication;
			$this->isPage 			= $isPage;
			$this->active			= $active;
			
			return $this;
		}

		public function append($templateName, $imgIcon, $admSource, $webSource, $alias=null, $comments=null, $childSchema=null)
		{
			//Aditional parameters to load list
			$this->templateName	=$templateName;
			$this->imgIcon		= $imgIcon;
			$this->admSource	= $admSource;
			$this->webSource	= $webSource;
			$this->alias 		= $alias;
			$this->comments 	= $comments;
			$this->childSchema 	= $childSchema;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>