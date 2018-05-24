<?php
	/**
	 * Object represents table 'crm_user'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2012-11-30 17:14
	 */
	class eCrmUser{
		
		public $userID;
		public $userName;
		public $password;
		public $firstName;
		public $lastName;
		public $email;
		public $state;
		public $glp;
		public $gnv;
		public $consulta_glp;
		public $consulta_gnv;
		public $reportes;

		public function __construct($userID=NULL, $userName=NULL, $password=NULL, $firstName=NULL, $lastName=NULL, $email=NULL, $state=NULL,$glp=NULL,$gnv=NULL,$consulta_glp=NULL,$consulta_gnv=NULL,$reportes=NULL)
		{
			$this->userID 		= $userID;
			$this->userName 	= $userName;
			$this->password 	= $password;
			$this->firstName	= $firstName;
			$this->lastName		= $lastName;
			$this->email		= $email;
			$this->state		= $state;
			$this->glp 			= $glp;
			$this->gnv 			= $gnv;
			$this->consulta_glp = $consulta_glp;
			$this->consulta_gnv = $consulta_gnv;
			$this->reportes 	= $reportes;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}		
	}
	?>



