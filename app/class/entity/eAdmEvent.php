<?php
	/**
	 * Object represents table 'adm_event'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eAdmEvent{
		
		public $eventID;
		public $moduleID;
		public $eventName;
		public $command;
		public $regEvent;
		
		public $profileID;

		public function __construct($eventID=null, $moduleID=null, $eventName=null, $command=null, $regEvent=null)
		{
			$this->eventID	= $eventID;
			$this->moduleID	= $moduleID;
			$this->eventName= $eventName;
			$this->command	= $command;
			$this->regEvent	= $regEvent;

			return $this;
		}

		public function append($profileID)
		{
			$this->profileID = $profileID;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>