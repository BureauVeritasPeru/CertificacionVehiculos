<?php
	/**
	 * Object represents table 'parameter'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsParameter{
		
		public $parameterID;
		public $parentParameterID;
		public $groupID;
		public $alias;
		public $position;

		public function __construct($parameterID=null, $parentParameterID=null, $groupID=null, $alias=null, $position=null)
		{
			$this->parameterID 	= $parameterID;
			$this->parentParameterID 	= $parentParameterID;
			$this->groupID 		= $groupID;
			$this->alias 		= $alias;
			$this->position		= $position;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>