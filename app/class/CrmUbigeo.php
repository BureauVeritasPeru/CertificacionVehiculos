<?php
require_once("base/Database.php");

class CrmUbigeo extends Database
{
	public static function  getDepartamento_List(){
		$sql = "SELECT * FROM crm_ubigeo
		WHERE 
            cod_dpto<>'00' AND
		    cod_prov='00' AND
            cod_dist='00'
		ORDER BY nombre";
		return parent::GetCollection(parent::GetResult($sql));
	}

    public static function  getProvincia_List($cod_dpto){
        $sql = "SELECT * FROM crm_ubigeo
        WHERE 
            cod_dpto='$cod_dpto' AND
            cod_prov<>'00' AND
            cod_dist='00'
        ORDER BY nombre";
        return parent::GetCollection(parent::GetResult($sql));
    }

    public static function  getDistrito_List($cod_dpto, $cod_prov){
        $sql = "SELECT * FROM crm_ubigeo
        WHERE 
            cod_dpto='$cod_dpto' AND
            cod_prov='$cod_prov' AND
            cod_dist<>'00'
        ORDER BY nombre";
        return parent::GetCollection(parent::GetResult($sql));
    }

	public static function  getDepartamento_Item($cod_dpto){
		$sql = "SELECT * FROM crm_ubigeo
                WHERE 
                    cod_dpto='$cod_dpto' AND
                    cod_prov='00' AND
                    cod_dist='00'
               ";
		return parent::GetObject(parent::GetResult($sql));
	}

    public static function  getProvincia_Item($cod_dpto, $cod_prov){
        $sql = "SELECT * FROM crm_ubigeo
                WHERE 
                    cod_dpto='$cod_dpto' AND
                    cod_prov='$cod_prov' AND
                    cod_dist='00'
               ";
        return parent::GetObject(parent::GetResult($sql));
    }
		
    public static function  getDistrito_Item($cod_dpto, $cod_prov, $cod_dist){
        $sql = "SELECT * FROM crm_ubigeo
                WHERE 
                    cod_dpto='$cod_dpto' AND
                    cod_prov='$cod_prov' AND
                    cod_dist='$cod_dist'
               ";
        return parent::GetObject(parent::GetResult($sql));
    }

}

?>