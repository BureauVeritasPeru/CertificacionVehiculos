<?php
require_once("base/Database.php");

class AdmLogin extends Database
{
    private static $arrUser = array();

    public static function Logon($userName, $password)
    {
        $oAdmUser=AdmUser::getItem_Login($userName, $password);
        if($oAdmUser!=null){
            
            $oAdmUser->fullName = $oAdmUser->firstName." ".$oAdmUser->lastName;
            
            $arrModule=array();
            $lUserEvents = AdmProfileEvent::getList_UserProfile($oAdmUser->profileID);
            foreach($lUserEvents as $obj){ //Add all events by user
                    if (!in_array($obj->moduleID, $arrModule)) $arrModule[]+=$obj->moduleID;
            }

            $arrMenu=array();
            $lUserMenu=AdmMenu::getList_UserProfile(implode(',', $arrModule));
            foreach($lUserMenu as $obj){ //Add all menus by user
                    $arrMenu[]+=$obj->menuID;
            }
            
            $oAdmUser->lUserEvents   =$lUserEvents;
            $oAdmUser->userMenu     =implode(',', $arrMenu);
            $oAdmUser->userModule   =implode(',', $arrModule);

            self::RegUserSession($oAdmUser);
            return $oAdmUser;
        }
        else 
            return NULL;
    }

    public static function getUserSession()
    {
        $oAdmUser=self::isLogged() ? unserialize($_SESSION[ADM_SESSION_ID]) : NULL;
        return $oAdmUser;
    }

    public static function RegUserSession($oAdmUser)
    {
        $_SESSION[ADM_SESSION_ID]=serialize($oAdmUser);
    }
    
    public static function UnregisterUser()
    {
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}		
        $_SESSION[ADM_SESSION_ID]=NULL;
    }

    public static function isLogged()
    {
        return isset($_SESSION[ADM_SESSION_ID]);
    }
}

?>
