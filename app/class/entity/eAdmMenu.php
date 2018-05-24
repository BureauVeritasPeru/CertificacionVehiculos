<?php
	/**
	 * Object represents table 'adm_menu'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eAdmMenu{
		
		public $menuID;
		public $parentMenuID;
		public $menuName;
		public $position;
		public $active;
		public $menuIcon;

		public function __construct($menuID=null, $parentMenuID=null, $menuName=null, $position=null, $active=null, $menuIcon=null)
		{
			$this->menuID 		= $menuID;
			$this->parentMenuID = $parentMenuID;
			$this->menuName 	= $menuName;
			$this->position 	= $position;
			$this->active		= $active;
			$this->menuIcon		= $menuIcon;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>