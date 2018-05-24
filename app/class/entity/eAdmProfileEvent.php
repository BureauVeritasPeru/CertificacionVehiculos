<?php
	/**
	 * Object represents table 'adm_profile_event'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eAdmProfileEvent{
		
		public $profileID;
		public $eventID;

		public $moduleID; //module ID (external object)
		public $command;  //required to able command action
                public $regEvent; //required to register event log

                public function __construct($profileID=null, $eventID=null)
		{
			$this->profileID= $profileID;
			$this->eventID 	= $eventID;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>