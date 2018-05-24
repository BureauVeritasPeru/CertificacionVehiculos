<?php
	/**
	 * Object represents table 'crm_form_field'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmFormField{
		
		public $fieldID;
		public $fieldName;
		public $alias;
		public $fieldType;
		public $options;
		public $active;

		public function __construct($fieldID=null, $fieldName=null, $alias=null, $fieldType=null, $options=null, $active=null)
		{
			$this->fieldID 		= $fieldID;
			$this->fieldName 	= $fieldName;
			$this->alias 		= $alias;
			$this->fieldType 	= $fieldType;
			$this->options	 	= $options;
			$this->active		= $active;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>