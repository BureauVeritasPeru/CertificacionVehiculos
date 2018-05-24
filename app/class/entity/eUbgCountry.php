<?php
    /**
     * Object represents table 'ubg_country'
     *
     * @author: Junior Huallullo
     * @date: 2011-04-07 16:59	 
     */
    class eUbgCountry{

        public $countryID;
        public $countryCode;
        public $countryName;
        public $active;

        public function __construct($countryID=null, $countryCode=null, $countryName=null, $active=null)
        {
                $this->countryID 	= $countryID;
                $this->countryCode 	= $countryCode;
                $this->stateCode 	= $countryName;
                $this->active		= $active;

                return $this;
        }

        public function __toString()
        {
                return Collection::objectToString($this);
        }
    }
?>