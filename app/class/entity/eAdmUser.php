<?php
/**
 * Object represents table 'adm_user'
 *
 * @author: Junior Huallullo
 * @date: 2011-04-07 16:59	 
 */
class eAdmUser{

    public $userID;
    public $userName;
    public $password;
    public $firstName;
    public $lastName;
    public $email;
    public $profileID;
    public $state;
    public $profileName;
    public $isDefault;
    
    public $lUserEvent;
    public $userMenu;
    public $userModule;

    public function __construct($userID=null, $userName=null, $password=null, $firstName=null, $lastName=null, $email=null, $profileID=null, $state=null, $profileName=null, $isDefault=null)
    {
        $this->userID       = $userID;
        $this->userName     = $userName;
        $this->password     = $password;
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
        $this->email        = $email;
        $this->profileID    = $profileID;
        $this->state        = $state;
        $this->profileName  = $profileName;
        $this->isDefault    = $isDefault;
    }

    public function __toString()
    {
        return Collection::objectToString($this);
    }

}
?>