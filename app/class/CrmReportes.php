<?php
require_once("base/Database.php");

class CrmReportes extends Database
{

	public static function  getItemReporteGeneralGLP($fechaIni,$fechaFin,$userID){
		$query = "SELECT c.formatoID, c.certificadoID, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, t.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario
		FROM glp_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN crm_sede s
		ON c.sedeID = s.sedeID INNER JOIN glp_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') AND c.estado = 1 AND c.usuarioID = '".$userID."'
		ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporteGeneralGLPA($fechaIni,$fechaFin,$userID,$tallerID,$placa){
		$query = "SELECT c.formatoID, c.certificadoID, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, p.vin, p.motor, c.estado, pt.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario,71 as tipoServicio
		FROM glp_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN crm_sede s
		ON c.sedeID = s.sedeID INNER JOIN glp_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID INNER JOIN crm_precio_taller pt 
		ON t.tallerID = pt.tallerID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 
		AND (pt.tallerID = c.tallerID AND pt.tipoCertificado = p.tipocertID AND pt.tipoServicio = 70) ";

		if($userID!='0'){$query.= " AND c.usuarioID = '".$userID."'";}
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		if($placa!=''){$query.= " AND p.placa = '".$placa."'";}
		$query .= "ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporteGeneralGNVA($fechaIni,$fechaFin,$userID,$tallerID,$placa){
		$query = "SELECT c.formatoID, c.certificadoID, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, p.vin, p.motor, c.estado, pt.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario,70 as tipoServicio
		FROM gnv_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN crm_sede s
		ON c.sedeID = s.sedeID INNER JOIN gnv_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID INNER JOIN crm_precio_taller pt 
		ON t.tallerID = pt.tallerID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 
		AND (pt.tallerID = c.tallerID AND pt.tipoCertificado = p.tipocertID AND pt.tipoServicio = 71) ";

		if($userID!='0'){$query.= " AND c.usuarioID = '".$userID."'";}
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		if($placa!=''){$query.= " AND p.placa = '".$placa."'";}
		$query .= "ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporteGeneralGNV($fechaIni,$fechaFin,$userID){
		$query = "SELECT c.formatoID, c.certificadoID, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, t.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario
		FROM gnv_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN crm_sede s
		ON c.sedeID = s.sedeID INNER JOIN gnv_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') AND c.estado = 1 AND c.usuarioID = '".$userID."'
		ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReportexTallerGLP($fechaIni,$fechaFin,$userID,$tallerID,$tipocertID){
		$query = "SELECT c.fechaEmi, p.placa, p.vin, p.motor, c.estado, t.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario
		FROM glp_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN glp_precertificado p
		ON c.precertID = p.precertID INNER JOIN crm_user u
		ON c.usuarioID = u.userID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') AND c.estado = 1 AND c.usuarioID = '".$userID."' AND c.tallerID = '".$tallerID."' AND p.tipocertID = '".$tipocertID."'
		ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReportexTallerGLPA($fechaIni,$fechaFin,$userID,$tallerID,$tipocertID,$placa){
		$query = "SELECT c.formatoID, c.certificadoID, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, p.vin, p.motor, c.estado, pt.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario
		FROM glp_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN crm_sede s
		ON c.sedeID = s.sedeID INNER JOIN glp_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID INNER JOIN crm_precio_taller pt 
		ON t.tallerID = pt.tallerID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 
		AND (pt.tallerID = c.tallerID AND pt.tipoCertificado = p.tipocertID AND pt.tipoServicio = 70) ";

		if($userID!='0'){$query.= " AND c.usuarioID = '".$userID."'";}
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		if($tipocertID!='0'){$query.= " AND p.tipocertID = '".$tipocertID."'";}
		if($placa!=''){$query.= " AND p.placa = '".$placa."'";}
		$query .= "ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReportexTallerGNVA($fechaIni,$fechaFin,$userID,$tallerID,$tipocertID,$placa){
		$query = "SELECT c.formatoID, c.certificadoID, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, p.vin, p.motor, c.estado, pt.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario
		FROM gnv_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN crm_sede s
		ON c.sedeID = s.sedeID INNER JOIN gnv_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID INNER JOIN crm_precio_taller pt 
		ON t.tallerID = pt.tallerID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 
		AND (pt.tallerID = c.tallerID AND pt.tipoCertificado = p.tipocertID AND pt.tipoServicio = 71) ";

		if($userID!='0'){$query.= " AND c.usuarioID = '".$userID."'";}
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		if($tipocertID!='0'){$query.= " AND p.tipocertID = '".$tipocertID."'";}
		if($placa!=''){$query.= " AND p.placa = '".$placa."'";}
		$query .= "ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReportexTallerGNV($fechaIni,$fechaFin,$userID,$tallerID,$tipocertID){
		$query = "SELECT c.fechaEmi, p.placa, p.vin, p.motor, c.estado, t.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario
		FROM gnv_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN gnv_precertificado p
		ON c.precertID = p.precertID INNER JOIN crm_user u
		ON c.usuarioID = u.userID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') AND c.estado = 1 AND c.usuarioID = '".$userID."' AND c.tallerID = '".$tallerID."' AND p.tipocertID = '".$tipocertID."'
		ORDER BY c.fechaEmi DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReportexTallerGral($fechaIni,$fechaFin,$tallerID){
		$query = "
		SELECT c.formatoID, c.certificadoID, pt.tipoServicio, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, p.vin, p.motor, c.estado, c.estadoFact, pt.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario, pl.parameterName AS tipoCertificado, pl.parameterID AS tipoCertificadoID 
		FROM glp_certificado c INNER JOIN crm_taller t ON c.tallerID = t.tallerID 
		INNER JOIN crm_sede s ON c.sedeID = s.sedeID 
		INNER JOIN glp_precertificado p ON c.precertID = p.precertID 
		INNER JOIN cms_parameter_lang pl ON p.tipocertID = pl.parameterID 
		INNER JOIN crm_user u ON c.usuarioID = u.userID
		INNER JOIN crm_precio_taller pt ON t.tallerID = pt.tallerID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 AND c.estadoFact = 0
		AND (pt.tallerID = c.tallerID AND pt.tipoCertificado = p.tipocertID AND pt.tipoServicio = 70)
		";
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		$query .= "
		UNION
		SELECT c.formatoID, c.certificadoID, pt.tipoServicio, t.razonSocial, s.descripcion AS sede, p.placa, c.fechaEmi, pl.parameterName AS tipo, p.ano_fab, p.vin, p.motor, c.estado, c.estadoFact, pt.costo, CONCAT(u.firstName, ' ', u.lastName) AS usuario, pl.parameterName AS tipoCertificado, pl.parameterID AS tipoCertificadoID
		FROM gnv_certificado c INNER JOIN crm_taller t ON c.tallerID = t.tallerID 
		INNER JOIN crm_sede s ON c.sedeID = s.sedeID 
		INNER JOIN gnv_precertificado p ON c.precertID = p.precertID 
		INNER JOIN cms_parameter_lang pl ON p.tipocertID = pl.parameterID 
		INNER JOIN crm_user u ON c.usuarioID = u.userID
		INNER JOIN crm_precio_taller pt ON t.tallerID = pt.tallerID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 AND c.estadoFact = 0
		AND (pt.tallerID = c.tallerID AND pt.tipoCertificado = p.tipocertID AND pt.tipoServicio = 71)
		";
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		$query .= "ORDER BY 7 DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemCertIncomp($fechaIni,$fechaFin,$userID,$tallerID,$tiposervID){
		$query = "
		SELECT c.formatoID, c.calcomaniaID, c.certificadoID, t.razonSocial, p.placa, c.fechaEmi, pa.parentParameterID AS tipoServicioID, pp.alias AS tipoServicio, pl.parameterID AS tipoCertificadoID, pl.parameterName AS tipo, CONCAT(u.firstName, ' ', u.lastName) AS usuario, u.userID
		FROM glp_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN glp_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID INNER JOIN cms_parameter pa
		ON pl.parameterID = pa.parameterID INNER JOIN cms_parameter pp
		ON pa.parentParameterID = pp.parameterID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."')  
		AND c.estado = 1 AND c.estadoFact = 0
		AND c.formatoID = 0 AND c.calcomaniaID = 0 
		";
		if($userID!='0'){$query.= " AND c.usuarioID = '".$userID."'";}
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		if($tiposervID!='0'){$query.= " AND pa.parentParameterID = '".$tiposervID."'";}
		$query .="
		UNION
		SELECT c.formatoID, c.calcomaniaID, c.certificadoID, t.razonSocial, p.placa, c.fechaEmi, pa.parentParameterID AS tipoServicioID, pp.alias AS tipoServicio, pl.parameterID AS tipoCertificadoID, pl.parameterName AS tipo, CONCAT(u.firstName, ' ', u.lastName) AS usuario, u.userID
		FROM gnv_certificado c INNER JOIN crm_taller t
		ON c.tallerID = t.tallerID INNER JOIN gnv_precertificado p
		ON c.precertID = p.precertID INNER JOIN cms_parameter_lang pl
		ON p.tipocertID = pl.parameterID INNER JOIN crm_user u
		ON c.usuarioID = u.userID INNER JOIN cms_parameter pa
		ON pl.parameterID = pa.parameterID INNER JOIN cms_parameter pp
		ON pa.parentParameterID = pp.parameterID
		WHERE (c.fechaEmi BETWEEN '".$fechaIni."' AND '".$fechaFin."') 
		AND c.estado = 1 AND c.estadoFact = 0
		AND c.formatoID = 0 AND c.calcomaniaID = 0 
		";
		if($userID!='0'){$query.= " AND c.usuarioID = '".$userID."'";}
		if($tallerID!='0'){$query.= " AND c.tallerID = '".$tallerID."'";}
		if($tiposervID!='0'){$query.= " AND pa.parentParameterID = '".$tiposervID."'";}
		$query .= "ORDER BY 5 DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}


	public static function  getItemReporte1P($fecha,$horaInicio,$horaFinal,$local){
		$date = new DateTime($fecha);
		$dateI = date_format($date, 'y/m/d');

		$query = "SELECT pl.regionPlanta,pl.puertoPlanta,pl.nombrePlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,c.numReporteCala,
		dc.correlativo,dc.fechaCala,c.codigoFaenaWeb,dc.horaCala,dc.latitud,dc.minLat,dc.segLat,dc.longitud,dc.minLong,dc.segLong,
		dc.tmDeclaradas,dc.porcJuveniles,dc.porcEspecie,pa.parameterName AS especie ,'-' AS comentarios,chi.pendiente

		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_cala c ON chi.chiID = c.chiID 
		LEFT JOIN   crm_detalle_cala dc  ON (dc.calaID = c.calaID) LEFT JOIN cms_parameter_lang pa ON dc.especie = pa.parameterID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial = '".$dateI."' AND chi.pendiente = 1
		ORDER BY chi.pendiente DESC,dc.detalleCalaID ASC,dc.correlativo ASC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporte1($fecha,$horaInicio,$horaFinal,$local){
		$date = new DateTime($fecha);
		$dateI = date_format($date, 'y/m/d');

		$nuevafecha = $date->add(new DateInterval('P1D'));
		$nuevafecha = date_format($nuevafecha, 'y/m/d');

		$query = "SELECT pl.regionPlanta,pl.puertoPlanta,pl.nombrePlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,c.numReporteCala,
		dc.correlativo,dc.fechaCala,c.codigoFaenaWeb,dc.horaCala,dc.latitud,dc.minLat,dc.segLat,dc.longitud,dc.minLong,dc.segLong,
		dc.tmDeclaradas,dc.porcJuveniles,dc.porcEspecie,pa.parameterName AS especie ,'-' AS comentarios,chi.pendiente

		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_cala c ON chi.chiID = c.chiID 
		LEFT JOIN   crm_detalle_cala dc  ON (dc.calaID = c.calaID) LEFT JOIN cms_parameter_lang pa ON dc.especie = pa.parameterID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND (((t.fechaInicial = '".$dateI."') AND t.horaInicio >= '".$horaInicio."') OR (t.fechaInicial = '".$nuevafecha."' AND t.horaInicio < '".$horaFinal."'))
		AND chi.pendiente = 0
		ORDER BY chi.pendiente DESC,dc.detalleCalaID ASC,dc.correlativo ASC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}


	public static function  getItemReporte2P($fecha,$horaInicio,$horaFinal,$local){
		$date = new DateTime($fecha);
		$dateI = date_format($date, 'y/m/d');

		$query = "SELECT pl.regionPlanta,pl.puertoPlanta,pl.nombrePlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,t.tmDescargado as descargaTM,t.fechaInicial AS fechaDescarga,
		m.porcJuveniles,m.moda,m.estadio,CONCAT(IFNULL(m.porcEspecie1,''),',',IFNULL(m.porcEspecie2,''),',',IFNULL(m.porcEspecie3,''),',',IFNULL(m.porcEspecie4,''),',',IFNULL(m.porcEspecie5,'')) AS porcEspecie,
		CONCAT(IFNULL(pa1.parameterName,''),',',IFNULL(pa2.parameterName,''),',',IFNULL(pa3.parameterName,''),',',IFNULL(pa4.parameterName,''),',',IFNULL(pa5.parameterName,'')) AS especie,
		CONCAT('Fecha de la Descarga:',DATE_FORMAT(t.fechaInicial,'%Y-%m-%d'),',Hora de Inicio:',t.horaInicio,'Hora de Término: ',t.horaTermino,' N° de RP: ',t.nroReportePesaje,'.',m.observaciones) AS observaciones,chi.pendiente

		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID 
		LEFT JOIN cms_parameter_lang pa1 ON m.especie1ID = pa1.parameterID 
		LEFT JOIN cms_parameter_lang pa2 ON m.especie2ID = pa2.parameterID 
		LEFT JOIN cms_parameter_lang pa3 ON m.especie3ID = pa3.parameterID 
		LEFT JOIN cms_parameter_lang pa4 ON m.especie4ID = pa4.parameterID 
		LEFT JOIN cms_parameter_lang pa5 ON m.especie5ID = pa5.parameterID  ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial = '".$dateI."' AND chi.pendiente = 1
		ORDER BY chi.pendiente DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporte2($fecha,$horaInicio,$horaFinal,$local){
		$date = new DateTime($fecha);
		$dateI = date_format($date, 'y/m/d');

		$nuevafecha = $date->add(new DateInterval('P1D'));
		$nuevafecha = date_format($nuevafecha, 'y/m/d');

		$query = "SELECT pl.regionPlanta,pl.puertoPlanta,pl.nombrePlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,t.tmDescargado as descargaTM,t.fechaInicial AS fechaDescarga,
		m.porcJuveniles,m.moda,m.estadio,CONCAT(IFNULL(m.porcEspecie1,''),',',IFNULL(m.porcEspecie2,''),',',IFNULL(m.porcEspecie3,''),',',IFNULL(m.porcEspecie4,''),',',IFNULL(m.porcEspecie5,'')) AS porcEspecie,
		CONCAT(IFNULL(pa1.parameterName,''),',',IFNULL(pa2.parameterName,''),',',IFNULL(pa3.parameterName,''),',',IFNULL(pa4.parameterName,''),',',IFNULL(pa5.parameterName,'')) AS especie,
		CONCAT('Fecha de la Descarga:',DATE_FORMAT(t.fechaInicial,'%Y-%m-%d'),',Hora de Inicio:',t.horaInicio,'Hora de Término: ',t.horaTermino,' N° de RP: ',t.nroReportePesaje,'.',m.observaciones) AS observaciones,chi.pendiente

		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID 
		LEFT JOIN cms_parameter_lang pa1 ON m.especie1ID = pa1.parameterID 
		LEFT JOIN cms_parameter_lang pa2 ON m.especie2ID = pa2.parameterID 
		LEFT JOIN cms_parameter_lang pa3 ON m.especie3ID = pa3.parameterID 
		LEFT JOIN cms_parameter_lang pa4 ON m.especie4ID = pa4.parameterID 
		LEFT JOIN cms_parameter_lang pa5 ON m.especie5ID = pa5.parameterID  ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND (((t.fechaInicial = '".$dateI."') AND t.horaInicio >= '".$horaInicio."') OR (t.fechaInicial = '".$nuevafecha."' AND t.horaInicio < '".$horaFinal."'))
		AND chi.pendiente = 0
		ORDER BY chi.pendiente DESC";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporte3($fecha,$horaInicio,$horaFinal,$local){
		$date = new DateTime($fecha);
		$dateI = date_format($date, 'y/m/d');

		$nuevafecha = $date->add(new DateInterval('P1D'));
		$nuevafecha = date_format($nuevafecha, 'y/m/d');

		$query = "SELECT pl.regionPlanta,pl.puertoPlanta,pl.nombrePlanta,t.fechaInicial,'ANCHOVETA' AS especie,m.nroParteMuestreo,e.nombreEmbarcacion, e.matriculaEmbarcacion,
		m.frecuencia8,m.frecuencia8_5,m.frecuencia9,m.frecuencia9_5,m.frecuencia10,m.frecuencia10_5,m.frecuencia11,m.frecuencia11_5,m.frecuencia12,m.frecuencia12_5,
		m.frecuencia13,m.frecuencia13_5,m.frecuencia14,m.frecuencia14_5,m.frecuencia15,m.frecuencia15_5,m.frecuencia16,m.frecuencia16_5,m.frecuencia17,m.frecuencia17_5,
		m.frecuencia18,m.moda,m.obsInusual as obsInusuales
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID 
		";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND (((t.fechaInicial = '".$dateI."') AND t.horaInicio >= '".$horaInicio."') OR (t.fechaInicial = '".$nuevafecha."' AND t.horaInicio < '".$horaFinal."'))";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}



	public static function  getItemReporte4($fechaInicio,$fechaFinal,$local){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT pl.regionPlanta,pl.puertoPlanta,pl.nombrePlanta,pl.zonaPlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,e.armador,t.nroTolva,t.nroReportePesaje,'ANCHOVETA' AS especie,
		t.capacidadBodega,t.tmDescargado,ch.pescaDeclarada,t.numActaInspeccion,t.fechaInicial,t.horaInicio,t.fechaFinal,t.horaTermino,'BUREAU VERITAS' AS empresaSupervisora
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID 
		";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}


	public static function  getItemReporte5($fechaInicio,$fechaFinal,$local){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT t.numActaInspeccion,t.fechaInicial,t.horaInicio,ro.numReporteOcurrencia,pla.parameterName AS infractor,pl.nombrePlanta,pl.regionPlanta, pl.puertoPlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,
		'ANCHOVETA' AS especie,ro.actaDecomiso,t.capacidadBodega,t.tmDescargado,ro.tmDecomisado,ro.subCodigoNumeroDecomiso,'BUREAU VERITAS' AS empresaSupervisora
		FROM crm_reporte_ocurrencia ro INNER JOIN crm_chi chi  ON chi.chiID = ro.chiID 
		INNER JOIN crm_chata ch  ON ch.chiID = chi.chiID  INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID
		INNER JOIN crm_tolva t ON t.chiID = chi.chiID  INNER JOIN cms_parameter_lang pla ON ro.infractor = pla.parameterID
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID
		";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporte6($fechaInicio,$fechaFinal,$local){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT t.numActaInspeccion,t.fechaInicial,t.horaInicio,m.nroParteMuestreo,m.porcJuveniles,pl.nombrePlanta, pl.puertoPlanta,pl.regionPlanta,e.nombreEmbarcacion , e.matriculaEmbarcacion,
		'ANCHOVETA' AS especie,'BUREAU VERITAS' AS empresaSupervisora
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		INNER JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID INNER JOIN  crm_muestreo m ON chi.chiID = m.chiID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}
	public static function  getItemReporte7C($fechaInicio,$fechaFinal,$local){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT t.fechaInicial,ch.numeroActaDesembarque as nroActa , 'Acta de Desembarque E/P' as tipoActa,ch.obsInusual as obsInusuales
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		LEFT JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		$query .= " AND ch.obsInusual <> '' ";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}
	public static function  getItemReporte7T($fechaInicio,$fechaFinal,$local){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT t.fechaInicial,t.numActaInspeccion as nroActa , 'Acta de Inspección Tolva' as tipoActa,t.obsInusual as obsInusuales
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		LEFT JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		$query .= " AND t.obsInusual <> '' ";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}
	public static function  getItemReporte7M($fechaInicio,$fechaFinal,$local){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT t.fechaInicial,m.nroParteMuestreo as nroActa , 'Parte de Muestreo' as tipoActa,m.obsInusual as obsInusuales
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		LEFT JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		$query .= " AND m.obsInusual <> '' ";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemReporte8($fechaInicio,$fechaFinal,$local,$planta){
		$dateI = new DateTime($fechaInicio);
		$dateI = date_format($dateI, 'y/m/d');
		$dateF = new DateTime($fechaFinal);
		$dateF = date_format($dateF, 'y/m/d');

		$query = "SELECT t.fechaInicial,e.nombreEmbarcacion , e.matriculaEmbarcacion,t.numActaInspeccion as nroActa ,t.tmDescargado as pesoTM
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		LEFT JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID ";
		$query .= "WHERE 1=1";
		if($local!='0'){$query.= " AND chi.localID = '".$local."'";} 
		$query .= " AND t.fechaInicial >= '".$dateI."' AND t.fechaInicial <= '".$dateF."'";
		$query .= " AND ch.plantaID= '".$planta."'";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemCertificacion($nroActaInspeccion){

		$query = "SELECT pl.puertoPlanta,t.fechaInicial,e.nombreEmbarcacion,pl.regionPlanta, pl.nombrePlanta, e.matriculaEmbarcacion,t.numActaInspeccion AS nroActa ,t.tmDescargado AS pesoTM,
		ch.numeroActaDesembarque,m.numeroActaMuestreo,i.nombrecompletoInspector as nombre1 ,i.codigoInspector as codigo1 ,it.nombrecompletoInspector as nombre2 ,it.codigoInspector as codigo2,
		im.nombrecompletoInspector as nombre3 ,im.codigoInspector as codigo3 , ch.cierrePuerto ,ch.pregunta1,ch.pregunta2,ch.pregunta3,ch.pregunta4,ch.pregunta5,t.pregunta6,t.pregunta7,t.pregunta8,
		t.pregunta9,t.pregunta10,m.pregunta11,m.pregunta12,m.reporteCala 
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		LEFT JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID
		LEFT JOIN crm_inspector i ON ch.inspectorID = i.inspectorID LEFT JOIN crm_inspector it ON t.inspectorID = it.inspectorID 
		LEFT JOIN crm_inspector im ON m.inspectorID = im.inspectorID ";
		$query .= "WHERE t.numActaInspeccion = '".$nroActaInspeccion ."'";

		return parent::GetObject(parent::GetResult($query));
		//echo $query;
	}	

	public static function  getListCertificacion($fecha,$planta){
		$date = new DateTime($fecha);
		$dateI = date_format($date, 'y/m/d');
		$nuevafecha = $date->add(new DateInterval('P1D'));
		$nuevafecha = date_format($nuevafecha, 'y/m/d');


		$query = "SELECT t.numActaInspeccion AS nroActa 
		FROM crm_chata ch INNER JOIN crm_planta pl ON ch.plantaID = pl.plantaID 
		INNER JOIN crm_chi chi ON ch.chiID = chi.chiID INNER JOIN crm_tolva t ON t.chiID = chi.chiID  
		LEFT JOIN crm_embarcacion e ON e.embarcacionID = t.embarcacionID LEFT JOIN  crm_muestreo m ON chi.chiID = m.chiID
		LEFT JOIN crm_inspector i ON ch.inspectorID = i.inspectorID LEFT JOIN crm_inspector it ON t.inspectorID = it.inspectorID 
		LEFT JOIN crm_inspector im ON m.inspectorID = im.inspectorID ";
		$query .= "WHERE pl.plantaID = '".$planta ."'";
		$query .= " AND (((t.fechaInicial = '".$dateI."') AND t.horaInicio >= '07:00') OR (t.fechaInicial = '".$nuevafecha."' AND t.horaInicio < '07:00'))";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	public static function  getTipoServ($state){
		switch($state){

			case 71:     return "GNV"; break;
			case 70:     return "GLP"; break;
		}
		return "";
	}
}

?>

