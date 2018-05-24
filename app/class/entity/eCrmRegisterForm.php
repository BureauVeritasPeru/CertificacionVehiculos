<?php
	/**
	 * Object represents table 'crm_register_form'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmRegisterForm{
		
		public $registerID;
		public $formID;
		public $registerCode;
		public $name;
		public $lastname;
		public $surname;
		public $phone;
		public $countryID;
		public $city;
		public $district;
		public $address;
		public $email;
		public $contactID;
		public $comment;
		public $optin;
		public $state;
		public $registerDate;
		public $reviewDate;

		public function __construct($registerID=NULL, $formID=NULL, $registerCode=NULL, $name=NULL, $lastname=NULL, $surname=NULL, $phone=NULL, $countryID=NULL, $city=NULL, $district=NULL, $address=NULL, $email=NULL, $contactID=NULL, $comment=NULL, $optin=NULL, $state=NULL, $registerDate=NULL, $reviewDate=NULL)
		{
			$this->registerID 	= $registerID;
			$this->formID 		= $formID;
			$this->registerCode	= $registerCode;
			$this->name 		= $name;
			$this->lastname 	= $lastname;
			$this->surname 		= $surname;
			$this->phone 		= $phone;
			$this->countryID 	= $countryID;
			$this->city 		= $city;
			$this->district 	= $district;
			$this->address 		= $address;
			$this->email 		= $email;
			$this->contactID 	= $contactID;
			$this->comment		= $comment;
			$this->optin 		= $optin;
			$this->state 		= $state;
			$this->registerDate	= $registerDate;
			$this->reviewDate 	= $reviewDate;

			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>