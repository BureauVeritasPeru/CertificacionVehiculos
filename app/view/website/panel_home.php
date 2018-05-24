<?php
//Home Values
$sectionID=1;
$langID=$PAGE->langID;

$parentContentID=0; //root
$lHome=CmsContentLang::getWebList($parentContentID, $sectionID, $langID);
?>


<?php if (!WebLogin::isLogged()){ ?>
	<style type="text/css">
		.form-control:focus {
			-webkit-box-shadow: none !important; 
			box-shadow: none !important; 
		}
		input {
			text-align: left !important; 
		}
		.form-control{
			font-family: "Segoe UI Webfont",-apple-system,"Helvetica Neue","Lucida Grande","Roboto","Ebrima","Nirmala UI","Gadugi","Segoe Xbox Symbol","Segoe UI Symbol","Meiryo UI","Khmer UI","Tunga","Lao UI","Raavi","Iskoola Pota","Latha","Leelawadee","Microsoft YaHei UI","Microsoft JhengHei UI","Malgun Gothic","Estrangelo Edessa","Microsoft Himalaya","Microsoft New Tai Lue","Microsoft PhagsPa","Microsoft Tai Le","Microsoft Yi Baiti","Mongolian Baiti","MV Boli","Myanmar Text","Cambria Math" !important;
			border-radius: 0px !important;
		}
		.btn-primary {
			font-family: inherit !important; 
			text-transform: none !important; 
			font-weight: 100 !important; 
		}
	</style>
	<link rel="stylesheet" type="text/css" href="<?php echo $URL_BASE;?>css/custom.css">

	<div><!--  --> 
		<div>
			<div class="background" role="presentation"><!-- ko if: smallImageUrl --> 
				<div class="blur" style="background-image: url(&quot;http://app.bureauveritas.com.pe/industria/certificacionvehiculos/userfiles/fondo.jpg&quot;);"></div><!-- /ko --><!-- ko if: backgroundImageUrl --> 
				<div class="backgroundImage" style="background-image: url(&quot;http://app.bureauveritas.com.pe/industria/certificacionvehiculos/userfiles/fondo.jpg&quot;);"></div><!-- /ko --><!-- ko if: !!backgroundImageUrl() --> 
				<div class="background-overlay"></div><!-- /ko --> 
			</div>
		</div> 
		<form name="login" id="login_produce" novalidate="novalidate" spellcheck="false" method="post" target="_top" autocomplete="off" ><!-- ko withProperties: { '$loginPage': $data } --> 
			<div class="outer">
				<div class="middle">
					<div class="inner"> 
						<div>
							<img class="logo" role="presentation"  src="http://app.bureauveritas.com.pe/produce/userfiles/logo_bv_header.gif"><!-- /ko --> <!-- /ko --><!-- /ko --> <!-- /ko -->
						</div><!-- /ko --> 
						<div>
							<div><!-- ko foreach: views --><!-- ko if: $parent.currentViewIndex() === $index() --> <!-- ko template: { nodes: [$data], data: $parent } -->
								<div data-viewid="1"><!--  --> 
									<div id="loginHeader" class="row text-title" role="heading">Sistema de Inspección y Certificación de Vehículos</div> 
									<div class="row text-body no-margin-top" > 
										<div id="loginDescription">Ingrese su usuario y contraseña.</div> 
									</div> 
									<div class="row"> 
										<div role="alert" aria-live="assertive" aria-atomic="false"><!-- ko if: error --><!-- /ko --> 
											<div class="alert alert-error col-md-24" id="usernameError"></div>
										</div> 
										<div class="form-group col-md-24"><!-- ko if: prefillNames().length > 1 --><!-- /ko --><!-- ko ifnot: prefillNames().length > 1 --> 
											<div class="placeholderContainer"><!-- ko withProperties: { '$placeholderText': placeholderText } --> <!-- ko template: { nodes: $componentTemplateNodes, data: $parent } --> 
												<input type="email" id="usuario_login" name="usuario_login" maxlength="113" class="form-control ltr_override" placeholder="Usuario*"> 
												<br>
												<input type="password" id="password_login" name="password_login" maxlength="113" class="form-control ltr_override" placeholder="Password*"> 
												<div id="usernameProgress" class="progress" role="progressbar" style="display: none;">
													<div></div>
													<div></div>
													<div></div>
													<div></div>
													<div></div>
													<div></div>
												</div>
											</div><!-- /ko --> 
										</div> 
									</div> 
									<div class="row"> 
										<div>
											<div class="col-xs-24 form-group no-padding-left-right"> 
												<div class="col-xs-12 secondary"> 
													<input type="button" id="idBtn_Back" class="btn btn-block"  value="Back" style="display: none;"> 
												</div> <div  class="col-xs-24"> 
												<div id="send-login" class="btn btn-block btn-primary">Ingresar
												</div>
											</div> 
										</div>
									</div> 
								</div> 
							</div> 


						</div> <!-- /ko -->
					</div><!-- ko if: desktopSsoRunning --><!-- /ko --><!-- /ko --><!-- ko if: showOptOutBanner --><!-- /ko --> 
					<div id="footer"> 
						<div><!-- ko if: showLinks || impressumLink || showIcpLicense --> 
							<div id="footerLinks" class="footerNode text-secondary"><!-- ko if: !showIcpLicense --> 
								<span id="ftrCopy" >©2017 Bureau Veritas</span><!-- /ko --> 
								<!-- <a id="ftrTerms" href="https://login.live.com/gls.srf?urlID=WinLiveTermsOfUse&amp;mkt=EN-US&amp;vv=1600">Terminos y Condiciones</a>  -->
								<a id="ftrPrivacy"  href="http://www.bureauveritas.com/footer/cookies/ ">Privacidad &amp; Cookies</a><!-- ko if: impressumLink --><!-- /ko --><!-- ko if: showIcpLicense --><!-- /ko --> 
							</div> <!-- /ko -->
						</div> 
					</div> 
				</form> 
				<script type="text/javascript">
					$(function(){
						prepareForm('#login_produce');
						$('.alert-error').hide();
						$('#send-login').click(function(){
							if (!isValidate('#login_produce')){ alert('Porfavor ingrese datos validos.'); return false; }

							var fields2=$('#login_produce').serialize();
							console.log('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2);
							$.getJSON('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2, function(data) {
								if(data.retval==1){
									console.log('entro');
									location.href='<?php echo SEO::get_URLHome();?>';
								}else{
									$('.alert-error').show();
									$('.alert-error').html(data.message);
								}
							});
						});
					});
				</script>
				<form method="post" target="_top" ><!-- ko foreach: postRedirectParams --><!-- /ko --> 
				</form>
			</div>
			<iframe id="idPartnerPL" height="0" width="0" src="https://outlook.office365.com/owa/prefetch.aspx?id=292841&amp;mkt=EN-US" style="display: none;"></iframe>
			<?php }else{ 
				include("../app/view/website/home/principal.php");
			} ?>
