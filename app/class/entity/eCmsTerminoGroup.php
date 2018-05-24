<?php
	/**
	 * Object represents table 'termino_group'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsTerminoGroup{
		
		public $groupID;
		public $groupName;
		public $active;

		public function __construct($groupID=null, $groupName=null, $active=null)
		{
			$this->groupID 		= $groupID;
			$this->groupName 	= $groupName;
			$this->active 		= $active;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>