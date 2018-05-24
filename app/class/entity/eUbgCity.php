<?php
/**
 * Object represents table 'ubg_city'
 *
 * @author: Junior Huallullo
 * @date: 2011-04-07 16:59	 
 */
class eUbgCity{

    public $cityID;
    public $stateID;
    public $cityName;
    public $active;

    public function __construct($cityID=null, $stateID=null, $cityName=null, $active=null)
    {
        $this->cityID       = $cityID;
        $this->stateID      = $stateID;
        $this->cityName     = $cityName;
        $this->active       = $active;

        return $this;
    }

    public function __toString()
    {
        return Collection::objectToString($this);
    }		
}
?>