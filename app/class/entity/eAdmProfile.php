<?php
	/**
	 * Object represents table 'adm_profile'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eAdmProfile{
		
		public $profileID;
		public $profileName;
		public $isDefault;
		public $events;

		public function __construct($profileID=null, $profileName=null, $isDefault=null)
		{
			$this->profileID 	= $profileID;
			$this->profileName 	= $profileName;
			$this->isDefault 	= $isDefault;
			
			return $this;
		}

		public function append($events)
		{
			$this->events = $events;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>