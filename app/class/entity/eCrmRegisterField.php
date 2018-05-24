<?php
	/**
	 * Object represents table 'crm_register_field'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmRegisterField{
		
		public $registerID;
		public $fieldID;
		public $value;
		public $textValue;

		public $fieldName;
		public $fieldType;
		public $options;

		public function __construct($registerID=null, $fieldID=null, $value=null, $textValue=null)
		{
			$this->registerID 	= $registerID;
			$this->fieldID 		= $fieldID;
			$this->value 		= $value;
			$this->textValue 	= $textValue;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString(self);
		}

	}
?>