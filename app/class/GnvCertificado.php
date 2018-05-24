<?php
require_once("base/Database.php");

class GnvCertificado extends Database
{

	public static function  getItem($certificadoID){
		$query = "	SELECT *
     FROM gnv_certificado
     WHERE certificadoID='$certificadoID' ";
     return parent::GetObject(parent::GetResult($query));
 }

 public static function  getList(){
  $query = " 	SELECT *
  FROM gnv_certificado
  ORDER BY certificadoID";
  return parent::GetCollection(parent::GetResult($query));
}

public static function  getItemByTaller($startDate, $endDate,$tipo,$tallerID,$usuarioID,$sedeID){
    $query ="
    SELECT  count(*) as certificadoID from gnv_certificado c INNER JOIN gnv_precertificado p ON (c.precertID = p.precertID)
    WHERE 1=1 ";
    $query .= " AND p.tipoCertID= '$tipo'";
    if ($tallerID!='0')
        $query .= " AND c.tallerID = '$tallerID'";
    if ($usuarioID!='0')
        $query .= " AND c.usuarioID = '$usuarioID'";
    if ($sedeID!='0')
        $query .= " AND c.sedeID = '$sedeID'";
    if (($startDate!='') && ($endDate!=''))
        $query .= " AND (c.fechaEmi BETWEEN '$startDate' AND '$endDate 23:59:59')";
    return parent::GetObject(parent::GetResult($query));
    //echo $query;
}

public static function  getItemByTallerEst($startDate, $endDate,$tipo,$tallerID,$usuarioID,$sedeID){
    $query ="
    SELECT  count(*) as certificadoID, SUM(f.costo) as formatoID from gnv_certificado c INNER JOIN gnv_precertificado p ON (c.precertID = p.precertID) INNER JOIN crm_facturacion_det f ON (c.certificadoID = f.certificadoID AND f.tipoServicio = 71 and f.tipoCertificadoID = p.tipoCertID)
    WHERE 1=1 ";
    $query .= " AND f.tipoCertificadoID= '$tipo'";
    if ($tallerID!='0')
        $query .= " AND c.tallerID = '$tallerID'";
    if ($usuarioID!='0')
        $query .= " AND c.usuarioID = '$usuarioID'";
    if ($sedeID!='0')
        $query .= " AND c.sedeID = '$sedeID'";
    if (($startDate!='') && ($endDate!=''))
        $query .= " AND (c.fechaEmi BETWEEN '$startDate' AND '$endDate 23:59:59')";
    return parent::GetObject(parent::GetResult($query));
    //echo $query;
}

public static function  getList_Paging($usuarioID, $filtroID, $filtro, $startDate, $endDate){
    $query ="
    SELECT c.certificadoID, c.fechaEmi, c.formatoID, p.placa,  IFNULL(IFNULL(CONCAT(cl.name, ' ', cl.lastname),cj.razonSocial),'Sin Titulo de Propiedad') AS cliente, CONCAT(u.firstName, ' ', u.lastName) AS usuario, c.estado,c.tallerID FROM gnv_certificado c INNER JOIN gnv_precertificado p
    ON c.precertID = p.precertID LEFT  JOIN crm_cliente cl ON c.clienteID = cl.clienteID LEFT JOIN crm_cliente_j cj ON cj.clienteID=c.clienteID 
    INNER JOIN crm_user u
    ON c.usuarioID = u.userID
    WHERE 1=1 ";
    if ($filtroID=='1')
        $query .= " AND c.certificadoID = '$filtro'";
    else if ($filtroID=='2')
        $query .= " AND c.formatoID = '$filtro'";
    else if ($filtroID=='3')
        $query .= " AND p.placa = '$filtro'";
    if (($startDate!='') && ($endDate!=''))
        $query .= " AND (c.fechaEmi BETWEEN '$startDate' AND '$endDate 23:59:59')";
    $query .= "AND u.userID='$usuarioID' ORDER BY c.fechaEmi DESC";
    return parent::GetCollection(parent::GetResultPaging($query));
    //echo $query;
}

public static function  AddNew($oGnvCert){
        //Search the max Id
    $query = " 	SELECT MAX(certificadoID) FROM gnv_certificado";
    $result = parent::GetResult($query);
    $oGnvCert->certificadoID = parent::fetchScalar($result)+1;
    $oGnvCert->varName    = $oGnvCert->certificadoID;
        //Insert data to table
    $query = " 	INSERT INTO gnv_certificado(certificadoID, usuarioID,tipoCliente, clienteID, precertID, tallerID, sedeID, fechaEmi, fechaVen, formatoID, calcomaniaID, observaciones, fechaCrea, fechaMod, estado)
    VALUES('$oGnvCert->certificadoID','$oGnvCert->usuarioID','$oGnvCert->tipoCliente','$oGnvCert->clienteID', '$oGnvCert->precertID', '$oGnvCert->tallerID', '$oGnvCert->sedeID', '$oGnvCert->fechaEmi', '$oGnvCert->fechaVen', '$oGnvCert->formatoID', '$oGnvCert->calcomaniaID', '$oGnvCert->observaciones', '$oGnvCert->fechaCrea', '$oGnvCert->fechaMod', '$oGnvCert->estado')";
    return parent::Execute($query);
}

public static function  Update($oGnvCert){
        //Update data to table
    $query = " 	UPDATE gnv_certificado SET 
    clienteID	='$oGnvCert->clienteID',
    tipoCliente   ='$oGnvCert->tipoCliente',
    tallerID ='$oGnvCert->tallerID',
    sedeID ='$oGnvCert->sedeID',
    fechaEmi ='$oGnvCert->fechaEmi',
    fechaVen ='$oGnvCert->fechaVen',
    observaciones ='$oGnvCert->observaciones',
    fechaMod ='$oGnvCert->fechaMod'
    WHERE certificadoID   =$oGnvCert->certificadoID";
    return parent::Execute($query);
        //echo $query;
}

public static function  UpdateFormato($newFormato, $certificadoID){
        //Update data to table
    $query = "  UPDATE gnv_certificado SET 
    formatoID   ='$newFormato'
    WHERE certificadoID   =$certificadoID";
    return parent::Execute($query);
        //echo $query;
}

public static function  UpdateCalcomania($newCalcomania, $certificadoID){
        //Update data to table
    $query = "  UPDATE gnv_certificado SET 
    calcomaniaID   ='$newCalcomania'
    WHERE certificadoID   =$certificadoID";
    return parent::Execute($query);
        //echo $query;
}

public static function  UpdateFact($certificadoID){
        //Update data to table
    $query = "  UPDATE gnv_certificado SET 
    estadoFact   ='1'
    WHERE certificadoID   =$certificadoID";
    return parent::Execute($query);
        //echo $query;
}

public static function  Delete($oGnvCert){
    $query = " 	DELETE FROM gnv_certificado 
    WHERE certificadoID ='$oGnvCert->certificadoID'";
    return parent::Execute($query);
}

public static function  getState($state){
    switch($state){

        case 1:     return "Emitido"; break;
        case 0:     return "Anulado"; break;
    }
    return "";
}

public static function  getStateFact($state){
    switch($state){

        case 1:     return "Facturado"; break;
        case 0:     return "Sin facturar"; break;
    }
    return "";
}

}
?>