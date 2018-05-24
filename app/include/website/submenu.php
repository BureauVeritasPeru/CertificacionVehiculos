<?php
if( isset($oContentLang) || isset($oSectionLang) ){

$langID	=$PAGE->langID;

$lSubMenu=isset($oContentLang)? CmsContentLang::getWebList_Menu(0, $oContentLang->sectionID, $oContentLang->langID): CmsContentLang::getWebList_Menu(0, $oSectionLang->sectionID, $oSectionLang->langID);

$arrParent=isset($PAGE->arrParent)? $PAGE->arrParent: array();
$title=TextParser::UpperCase($oSectionLang->title);
?>
	<ul>
<?php
	foreach( $lSubMenu as $oSubMenu )
	{
		$selected	=(in_array($oSubMenu->contentID, $arrParent) || (isset($oContentLang) && $oSubMenu->contentID==$oContentLang->contentID));
		$html_link	=HtmlElement::get_LinkScript($oSubMenu, NULL, $oSubMenu->title);
		
		echo '<li '.($selected? 'class="active"': '').'>' .$html_link. '</li>'."\n";
	}
?>
	</ul>
<?php
}
?>