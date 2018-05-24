<?php
require_once("base/Database.php");

class WebLogin extends Database
{
	private static $oUser;

	public static function Logon($email, $password, $rememberMe=false)
	{
		self::$oUser=CrmUser::getItem_Login($email, $password);
		if(self::$oUser!=NULL){
			self::RegUserSession($rememberMe);
			return true;
		}
		else 
			return false;
	}

	public static function LogonFacebook($facebookID, $rememberMe=false)
	{
		if(empty($facebookID)){
			return false;
		}

		self::$oUser=CrmUser::getItem_FacebookID($facebookID);
		if(self::$oUser!=NULL){
			self::RegUserSession($rememberMe);
			return true;
			}
		else 
			return false;
	}

	public static function RescueNotify($email)
	{
		$oUser=CrmUser::getItem_Email($email);
		if($oUser!=NULL){
			$oRescue=new CrmUserRescue();
			$oRescue->userID=$oUser->userID;
			$oRescue->hashcode=hash('md5', uniqid($oUser->userID));
	        if(!CrmUserRescue::AddNew($oRescue)){
	            self::SetErrorMsg(CrmUserRescue::GetErrorMsg());
				return false;
	        }
	        if(!Email::Send_RescueNotify($oUser, $oRescue)){
	            self::SetErrorMsg(Email::$ErrorMessage);
				return false;
	        }
		}
		else{
			self::SetErrorMsg('La cuenta de correo ingresada no existe.');
			return false;
		}

		return true;
	}

	function RescueLogon($hash){
		$hashcode=XCrypt::Decrypt($hash,'PCDA@@forgot__');
		$oRescue=CrmUserRescue::getItem_HashCode($hashcode);
		if($oRescue!=NULL){
			if($oRescue->recuperado){
				self::SetErrorMsg('La acción requerida ha expirado, por favor inténtelo nuevamente.');
				return false;
			}

			$oRescue->recuperado=true;
			CrmUserRescue::Update_Recuperado($oRescue);

			$oUser=CrmUser::getItem($oRescue->userID);
			self::SetErrorMsg(CrmUser::GetErrorMsg());

			return $oUser;
		}
		else{
			self::SetErrorMsg('los datos proporcionados no son válidos');
			return false;
		}
	}

	public static function getUserSession()
	{
		self::$oUser=self::isLogged() ? unserialize($_SESSION['USER_INFO']) : NULL;
		return self::$oUser;
	}

	public static function setUserSession($oUser)
	{
		self::$oUser=$oUser;
		return self::RegUserSession();
	}

	public static function RegUserSession($rememberMe=false)
	{
		$_SESSION['USER_INFO']=serialize(self::$oUser);
		if($rememberMe){
			$expire=time()+(3600*24*365);
			setcookie('USER_INFO', serialize($_SESSION['USER_INFO']), $expire, '/');
		}
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
		$_SESSION['USER_INFO']=NULL;
	}

	public static function isLogged()
	{
		if(isset($_COOKIE['USER_INFO'])) $_SESSION['USER_INFO']=$_COOKIE['USER_INFO'];
		
		return isset($_SESSION['USER_INFO']);
	}
}

?>