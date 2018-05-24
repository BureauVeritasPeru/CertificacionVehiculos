<?php
foreach(CmsTerminoLang::getWebList(1, $PAGE->langID) as $obj)
	$arrTerm[$obj->varName]=$obj->terminoName;
?>
<h1><?php echo $oContentLang->title;?></h1>
<div>
	<?php echo $oContentLang->description;?>
    
	<div id="Formulario">
	  <form name="frmSubmit" id="frmSubmit" enctype="multipart/form-data" method="post" target="hideFrame">
   <table border="0" cellspacing="0" cellpadding="0" class="FormTable">
      <tr>
        <td><select name="field[area_interes]" id="area_interes" class="required" placeholder="AREA DE INTERES*">
          <option value="">AREA DE INTERES*</option>
<?php
$groupID=1; //Areas de Interes
$lAreas=CmsParameterLang::getWebList($groupID, $PAGE->langID);
foreach($lAreas as $oArea){
?>          
          <option value="<?php echo $oArea->parameterID;?>"><?php echo TextParser::UpperCase($oArea->parameterName);?></option>
<?php
}
?>
        </select></td>
      </tr>
     <tr>
       <td><input type="text" name="name" id="name" class="required" placeholder="NOMBRES*"></td>
     </tr>
     <tr>
       <td><input type="text" name="lastname" id="lastname" class="required" placeholder="APELLIDO PATERNO*"></td>
     </tr>
     <tr>
       <td><input type="text" name="surname" id="surname" placeholder="APELLIDO MATERNO"></td>
     </tr>
     <tr>
       <td><input type="text" name="phone" id="phone" class="required numeric" placeholder="TEL&EACUTE;FONO DE CONTACTO*"></td>
     </tr>
     <tr>
       <td><input type="text" name="email" id="email" class="required email" placeholder="EMAIL*"></td>
     </tr>
	<tr>
      <td><input type="file" name="field[curriculum]" id="curriculum" /></td>
    </tr>
   </table>
	  <span class="a-anaranjado"><a href="javascript:;" id="btnSubmit">ENVIAR</a></span>
	 </form>
	</div>
    <div id="divMessage" style="display:none">
	    <br />
    	<div class="title"><strong><?php echo $arrTerm["gracias_registro"];?></strong></div>
	    <p><?php echo $arrTerm["envio_exitoso"];?></p>
    </div>

</div>
<script type="text/javascript">
  function getMessage(retVal, msg){
    $("#loading").remove();

    if(retVal==1){
            $("#divMessage").show();
    }else{
            $("#Formulario").show('fast');
            alert('<?php echo $arrTerm["error_envio"];?>');
    }
  }
  $(function(){

    $('#btnSubmit').click(function(){
            if (!isValidate("#frmSubmit")) return false;

            $("#Formulario").hide('slow');
            $('#Formulario').after('<iframe id="hideFrame" name="hideFrame" style="display:none"></iframe>'); //Target Post
            $('#Formulario').after('<div id="loading"><span>Enviando...</span><img src="<?php echo $URL_BASE;?>images/ajax-loader.gif" /></div>');
            var formID=7; //Postulante
            $('#frmSubmit').attr('action', '<?php echo SEO::get_URLRoot();?>ajax/form_post.php?formID='+formID);
            $('#frmSubmit').submit();

            return false; 
    });
  });
</script>