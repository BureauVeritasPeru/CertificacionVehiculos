<?php
    /**
     * Object represents table 'ubg_state'
     *
     * @author: Junior Huallullo
     * @date: 2011-04-07 16:59	 
     */
    class eUbgState{

        public $stateID;
        public $countryID;
        public $stateName;
        public $active;

        public function __construct($stateID=null, $countryID=null, $stateName=null, $active=null)
        {
                $this->stateID 		= $stateID;
                $this->countryID 	= $countryID;
                $this->stateName 	= $stateName;
                $this->active		= $active;

                return $this;
        }

        public function __toString()
        {
                return Collection::objectToString($this);
        }		
    }
?>