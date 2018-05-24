<?php
	/**
	 * Object represents table 'cms_section_lang'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsSectionLang{
		
		var $sectionID;
		var $langID;
		var $title;
		var $subTitle;
		var $description;
		var $resumen;
		var $media;
		var $parameter;
		var $metaTag;
		var $showContent;
		var $staticURL;
		var $active;

		//Aditional parameters to load list
		var $parentSectionID;
		var $sectionName;
		var $position;
		var $isEditable;
		
		public function __construct($sectionID=NULL, $langID=NULL, $title=NULL, $subTitle=NULL, $description=NULL, $resumen=NULL, $media=NULL, $parameter=NULL, $metaTag=NULL, $showContent=NULL, $staticURL=NULL, $active=NULL)
		{
			$this->sectionID 		= $sectionID;
			$this->langID 			= $langID;
			$this->title 			= $title;
			$this->subTitle 		= $subTitle;
			$this->description 		= $description;
			$this->resumen	 		= $resumen;
			$this->media			= $media;
			$this->parameter		= $parameter;
			$this->metaTag			= !is_null($metaTag)? array('title'=>'', 'description'=>'', 'keywords'=>''): $metaTag;
			$this->showContent 		= $showContent;
			$this->staticURL 		= $staticURL;
			$this->active			= $active;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
		
	}
?>