<?php
require_once("../../app/class/util/phpmailer/class.phpmailer.php");

class Email{
    public static $ErrorMessage;

    public static function getTemplate($template, $replacement){
        $content = file_get_contents("../../app/view/mail/template/".$template);

        while(list($key, $val) = each($replacement)){
            //echo "<li>$key - $val</li>";
            $content=str_replace($key, $val, $content);
        }
        return $content;
    }

    public static function setBody($asunto, $mensaje){
        global $WEBSITE;
        $body = self::getTemplate("default.html", array(
                    "@@ASUNTO@@"=>$asunto,
                    "@@MENSAJE@@"=>$mensaje,
                    "@@URL_HTTP@@"=>SEO::Get_HTTPSite()));

        return $body;
    }

    public static function Send_Recomienda($name, $name_to, $mail_to){
        global $WEBSITE;

        $asunto='Recomienda esta p&aacute;gina';
        $mensaje='Hola '.$name_to.', tu amigo(a) '.$name.' te recomienda ver esta p&aacute;gina: <br /><a href="'.SEO::Get_HTTPSite().'">'.SEO::Get_HTTPSite().'</a>';
        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"], $mail_to, $asunto, $body);
    }

    public static function Send_RegisterForm($registerID){
        global $WEBSITE;

        $oRegForm=CrmRegisterForm::getItem($registerID);
        if($oRegForm==NULL){
            self::$ErrorMessage='El usuario no se encuentra registrado.';
            return false;
        }

        $oForm=CrmForm::getItem($oRegForm->formID);
        $lNotify=CrmFormNotify::getList($oRegForm->formID, $oRegForm->contactID);
        if($lNotify->getLength()==0){
            self::$ErrorMessage='No tiene destinatarios asignados.';
            return false;
        }

        $oCountry=UbgCountry::getItem($oRegForm->countryID); //Nombre de Pais
        $oContact= CmsParameterLang::getItem($oRegForm->contactID, 1); //Asunto de Contacto

        //Obtener Lista de Datos Adicionales
        $lRegFields=CrmRegisterField::getList($registerID);

        $asunto=$oForm->formName;
        $mensaje ='<p>Se ha registrado un nuevo ingreso en el formulario '.$oForm->formName.'.</p>'."\n";
        $mensaje.='<strong>Datos Comunes: </strong>'."\n";
        $mensaje.='<table>'."\n";
        if($oRegForm->name!='') $mensaje.='<tr><td width="100">Nombres</td><th align="left">'.$oRegForm->name.'</th></tr>'."\n";
        if($oRegForm->lastname!='') $mensaje.='<tr><td>Apellido P.</td><th align="left">'.$oRegForm->lastname.'</th></tr>'."\n";
        if($oRegForm->surname!='') $mensaje.='<tr><td>Apellido M.</td><th align="left">'.$oRegForm->surname.'</th></tr>'."\n";
        if($oRegForm->phone!='') $mensaje.='<tr><td>Telefono</td><th align="left">'.$oRegForm->phone.'</th></tr>'."\n";
        if($oCountry!=NULL) $mensaje.='<tr><td>Pa&iacute;s</td><th align="left">'.$oCountry->countryName.'</th></tr>'."\n";
        if($oRegForm->city!='') $mensaje.='<tr><td>Ciudad</td><th align="left">'.$oRegForm->city.'</th></tr>'."\n";
        if($oRegForm->district!='') $mensaje.='<tr><td>Distrito</td><th align="left">'.$oRegForm->district.'</th></tr>'."\n";
        if($oRegForm->email!='') $mensaje.='<tr><td>E-mail</td><th align="left">'.$oRegForm->email.'</th></tr>'."\n";
        if($oContact!=NULL) $mensaje.='<tr><td>Asunto de Contacto</td><th align="left">'.$oContact->parameterName.'</th></tr>'."\n";
        if($oRegForm->comment!='') $mensaje.='<tr><td>Comentario</td><th align="left">'.$oRegForm->comment.'</th></tr>'."\n";
        $mensaje.='<tr><td>Fecha de Registro</td><th align="left">'.$oRegForm->registerDate.'</th></tr>'."\n";
        $mensaje.='</table><br>'."\n";

        $mensaje.='<strong>Datos Adicionales: </strong>'."\n";
        $mensaje.='<table>'."\n";
        foreach($lRegFields as $obj){
                $mensaje.='<tr><td width="100">'.$obj->fieldName.'</td><th align="left">'.CrmRegisterField::getValue($obj, $oRegForm->formID).'</th></tr>'."\n";
        }
        $mensaje.='</table>'."\n";

        $mensaje.='<p>Para acceder a toda la informaci&oacute;n, ingresar al administrador web<br> >>Informacion General >>Formularios >> Mensajes recibidos</p>'."\n";
        $mensaje.='<a href="'.SEO::Get_HTTPAdmin().'">'.SEO::Get_HTTPAdmin().'</a>'."\n";

        //Aplicar Plantilla
        $body =self::setBody($asunto, $mensaje);

        //Destinatarios con Copia
        foreach($lNotify as $oNotify){
                $cc=($oNotify->recipients!='')? $oNotify->recipients: NULL;
                //echo "$WEBSITE[ADMIN_MAIL], $WEBSITE[ADMIN_NAME], $oNotify->email, $asunto, $body, $cc"; exit;
                if(!self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"], $oNotify->email, $asunto, $body, $cc)){
                    self::$ErrorMessage='Ocurrio un error al enviar un mail ('.$oNotify->email.')';
                    return false;
                }
        }

        return true;
    }

    public static function Send($from, $fromName, $to, $subject, $body, $cc=NULL){
        $mail = new PHPMailer();
        //$mail->IsSMTP(); // telling the class to use SMTP

        $mail->SetFrom($from, $fromName);
        $mail->AddAddress($to);   // name is optional
        $mail->Subject = $subject;
        $mail->AltBody = "Para ver este mensaje, por favor utilizar una aplicacion de correo compatible con HTML"; // optional, comment out and test
        //die($body);
        $mail->MsgHTML($body);

        //Add Recipients
        if($cc!=NULL && $cc!=''){
            $aCc=explode(",", $cc);
            if(!is_array($aCc)){
                $mail->AddCC(trim($cc));
            }
            else{
                foreach($aCc as $addr){
                    if($addr!='') $mail->AddCC(trim($addr));
                }
            }
        }

        return $mail->Send();
    }
}?>