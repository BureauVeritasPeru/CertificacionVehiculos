<?php
/**
 * Object represents table 'cms_content'
 *
 * @author: Junior Huallullo
 * @date: 2011-04-09 20:46	 
 */
class eCmsContent{

    var $contentID;
    var $parentContentID;
    var $schemaID;
    var $contentName;
    var $position;

    //Aditional parameters to load list
    var $sectionID; //from cms_section

    public function __construct($contentID=null, $parentContentID=null, $schemaID=null, $contentName=null, $position=null)
    {
        $this->contentID        = $contentID;
        $this->parentContentID  = $parentContentID;
        $this->schemaID         = $schemaID;
        $this->contentName      = $contentName;
        $this->position         = $position;
    }

    public function append($sectionID)
    {
        $this->sectionID = $sectionID;
    }

    public function __toString()
    {
        return Collection::objectToString($this);
    }

}
?>