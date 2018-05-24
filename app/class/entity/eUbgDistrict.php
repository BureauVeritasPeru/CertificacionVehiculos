<?php
/**
 * Object represents table 'ubg_district'
 *
 * @author: Junior Huallullo
 * @date: 2011-04-07 16:59	 
 */
class eUbgDistrict{

    public $districtID;
    public $cityID;
    public $districtName;
    public $active;

    public function __construct($districtID=null, $cityID=null, $districtName=null, $active=null)
    {
        $this->districtID   = $districtID;
        $this->cityID       = $cityID;
        $this->districtName = $districtName;
        $this->active       = $active;

        return $this;
    }

    public function __toString()
    {
        return Collection::objectToString($this);
    }		
}
?>