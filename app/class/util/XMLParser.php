<?php

class XMLParser{

	public static function ParseArray($arr){
		//Parse Array to XML
		$sxe = new SimpleXMLElement("<root></root>");
		if(is_array($arr)){
		  foreach($arr as $alias => $value){
			$listItem = $sxe->addChild('item');
			$listItem->addAttribute('key', $alias);
			$listItem->addAttribute('value', utf8_encode(is_array($value)? implode (",", $value): $value));
		  }
		}
		return $sxe->asXML();
	}

	public static function getArray($xml){
		//Get Params Array
		$arr=array();
		if($xml!=''){
			$objXml = simplexml_load_string($xml, null, LIBXML_NOERROR);
			foreach ($objXml->item as $item)
				$arr["$item[key]"]=utf8_decode($item["value"]);
		}
		return $arr;
	}

	public static function getValue($xml, $param){
		//Get Parameter Value
		$value=NULL;
		if($xml!=''){
			$objXml = simplexml_load_string($xml, null, LIBXML_NOERROR);
			foreach ($objXml->item as $item){
				if($param==$item["key"]){
					$value=utf8_decode($item["value"]);
					break;
				}
			}
		}
		return $value;
	}

}

?>