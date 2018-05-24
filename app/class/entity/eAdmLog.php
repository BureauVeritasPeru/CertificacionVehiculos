<?php
	/**
	 * Object represents table 'adm_log'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2013-10-18 12:48	 
	 */
	class eAdmLog{
		
		public $eventID;
		public $logDate;
		public $userID;
		public $comment;
		public $object;

                public $userName;
                public $eventName;
        
		public function __construct($eventID=null, $logDate=null, $userID=null, $comment=null, $object=null)
		{
			$this->eventID 	= $eventID;
			$this->logDate 	= $logDate;
			$this->userID 	= $userID;
			$this->comment 	= $comment;
			$this->object 	= $object;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>