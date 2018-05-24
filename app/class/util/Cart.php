<?php
require_once("base/Database.php");

class Cart{
//var $myCart = array();
var $myCart;
var $Error;

	function Cart($cart){
		$this->myCart=$cart;
		if (isset($this->myCart))
			ksort($this->myCart);
		else
			$this->myCart=array();
	}
	
	function AddItem($ProductID, $Quantity, $Params){
	//Validate from Catalog
		$bExist=false;
		while (list($key, $item) = each($this->myCart)) {
			if($item["ProductID"]==$ProductID && $item["Params"]==$Params){
				$item["Quantity"]+= $Quantity;
				$bExist=true; break;
			}
		}
		if(!$bExist){
			$cProduct 	= new Product();
			$cModel		= new Model();
			$cParameter = new Parameter();
			if(!($rslt=$cProduct->getItem($ProductID))) return false;

			$rs=$cProduct->fetchArray($rslt);
			$ProductName =$rs["fullname"];
			$rslt=$cModel->getItem($rs["id_model"]);
			$ImgModel =($rs=$cModel->fetchArray($rslt))? $rs["img_icon"] : "";

			$Description = $ProductName." <br />";
			foreach($Params as $param){
				if($param!=""){
					$rslt=$cParameter->getItem($param);
					$ParamName	 =($rs=$cParameter->fetchArray($rslt))? $rs["fullname"] : "";
					$Description.= "(". $ParamName.") ";
				}
			}
			
			$kID=count($this->myCart);
			$this->myCart[$kID]["ProductID"]	= $ProductID;
			$this->myCart[$kID]["Quantity"] 	= $Quantity;
			$this->myCart[$kID]["Params"] 		= $Params;
			$this->myCart[$kID]["Description"]	= $Description;
			$this->myCart[$kID]["ImgModel"]		= $ImgModel;
			
		}
		return true;
	}
	
	function Delete($kID){
		unset($this->myCart[$kID]);
	return true;
	}
	
	function Clear(){
		unset($this->myCart);
	return true;
	}
	
	function Update($kID, $Quantity){
	
		if(is_array($Quantity)){
			$this->Error=3;
			return false;
		}
		if(!isset($this->myCart[$kID]["ProductID"])){
			$this->Error=2;
			return false;
		}
		if ($Quantity==0){
			$this->Delete($kID);
		}
		else{
			$this->myCart[$kID]["Quantity"] = $Quantity;
		}
	return true;
	}

	function getErrorMessage(){
		switch($this->Error){
			case 1:
				$msg="Error found while add to cart";
				break;
			case 2:
				$msg="Error found while update cart";
				break;
			case 3:
				$msg="Error found while update cart (Quantity=Array)";
				break;
			default:
				$msg="Error found while process cart";
				break;
		}
		return $msg;
	}
}
?>