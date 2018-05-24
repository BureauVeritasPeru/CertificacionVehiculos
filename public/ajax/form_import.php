<?php
session_start();
require_once("../../config/main.php");

$aFile=isset($_FILES['fleImport'])? $_FILES['fleImport']: NULL;

if($aFile!=NULL){
    $message = "";
    $buffer=file_get_contents($aFile["tmp_name"]);
    $data=str_getcsv($buffer, "\n");
    if(count($data)>1){
        $data[0]=NULL;
        $data=array_filter($data);
        $numRows=0;$count=0;
        foreach($data as $row){
            $count++;
            //$r = str_getcsv($row, "\t"); //Tabulacion
            $r = str_getcsv($row, ","); // comas
            $oEmbarcacion=new eCrmEmbarcacion();

            $oEmbarcacion->numeralEmbarcacion       = $r[0];
            $oEmbarcacion->nombreEmbarcacion        = $r[1];
            $oEmbarcacion->matriculaEmbarcacion     = $r[2];
            $oEmbarcacion->casco                    = $r[3];
            $oEmbarcacion->regimen                  = $r[4];
            $oEmbarcacion->tipoPreservacion         = $r[5];
            $oEmbarcacion->eslora                   = $r[6];
            $oEmbarcacion->manga                    = $r[7];
            $oEmbarcacion->puntal                   = $r[8];
            $oEmbarcacion->capbod_m3                = $r[9];
            $oEmbarcacion->capbod_tm                = $r[10];
            $oEmbarcacion->resolucion               = $r[11];
            $oEmbarcacion->permisoPesca             = $r[12];
            $oEmbarcacion->permisoZarpe             = $r[13];
            $oEmbarcacion->codigoPago               = $r[14];
            $oEmbarcacion->transmisor               = $r[15];
            $oEmbarcacion->armador                  = $r[16];
            $oEmbarcacion->precinto                 = $r[17];
            $oEmbarcacion->aparejo                  = $r[18];
            $oEmbarcacion->especieChi               = $r[19];
            $oEmbarcacion->especieChd               = $r[20];
            $oEmbarcacion->pmceNorteCentro          = $r[21];
            $oEmbarcacion->pmceSur                  = $r[22];
            $oEmbarcacion->nominadaNorteCentro      = $r[23];
            $oEmbarcacion->nominadaSur              = $r[24];
            $oEmbarcacion->convenioNorteCentro      = $r[25];
            $oEmbarcacion->convenioSur              = $r[26];
            $oEmbarcacion->grupoNorteCentro         = $r[27];
            $oEmbarcacion->grupoSur                 = $r[28];
            $oEmbarcacion->state                    = 1;

            if($oEmbarcacion->numeralEmbarcacion != ''){
                $numRows++;
                CrmEmbarcacion::AddNew($oEmbarcacion);
            }else{
                $message .= "<span>No Se pudo Registrar la fila ".$count."</span><br>";
            }
        }

        $message .= "<span>Se han insertado ".$numRows." registros.</span><br>";
    }else{
     $message .= "<span>No se han encontrado registros.</span><br>" ;
 }

}else{
 $message .= "<span>No se ha seleccionado un archivo para importar.</span><br>";
    //Common Field
}


echo $message;







?>