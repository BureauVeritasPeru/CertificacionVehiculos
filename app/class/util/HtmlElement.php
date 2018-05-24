<?php

class HtmlElement{

	public static function get_MediaScript($oMediaLang, $width=0, $height=0){
		//Retrive properties
		if($oMediaLang==NULL) return '';
		
		$urlFile='../'.$oMediaLang->basePath.$oMediaLang->mediaName;
		switch($oMediaLang->mediaType){
			case 'image':
				if($width==0 and $height==0) list($width, $height) = getimagesize($urlFile);
				$html='<img src="'.$urlFile.'" alt="'.$oMediaLang->alt.'" title="'.$oMediaLang->title.'" width="'.$width.'" height="'.$height.'" />';
				break;
			case 'animation':
				$divID=$oMediaLang::$alias.'_'.$oMediaLang->contentID.'_'.$oMediaLang->mediaID;
				if($width==0 and $height==0) list($width, $height) = getimagesize($urlFile);
				$html='<div id="'.$divID.'">Necesita habilitar Adobe Flash Player v.9</div>
				<script type="text/javascript"> swfobject.embedSWF("'.$urlFile.'", "'.$divID.'", "'.$width.'", "'.$height.'", "9.0.0"); </script>';
				break;
			case 'video':
				$html='<a href="'.$urlFile.'" title="'.$oMediaLang->title.'" >'.$oMediaLang->title.'</a>';
				break;
			case 'audio':
				$html='<a href="'.$urlFile.'" title="'.$oMediaLang->title.'" >'.$oMediaLang->title.'</a>';
				break;
			case 'document':
				$html='<a href="'.$urlFile.'" title="'.$oMediaLang->title.'" >'.$oMediaLang->title.'</a>';
				break;
			default:
				$html='<a href="'.$urlFile.'" title="'.$oMediaLang->title.'" >'.$oMediaLang->title.'</a>';
				break;
		}
		
		
		return $html;
	}

	public static function get_LinkScript($oContentLang, $class=NULL, $text=NULL){
		//Retrive properties
		if($oContentLang==NULL) return '';
		
		$oLink=SEO::get_ContentLink($oContentLang);
		$text	=($text!=NULL)? $text: $oLink->text;
		$class	=($class!=NULL)? ' class="' .$class. '" ': '';
		$target	=($oLink->target!=NULL)? ' target="' .$oLink->target. '" ': '';
		
		if($oLink->url=='#')
			$html=$text;
		else
			$html='<a href="' .$oLink->url. '" ' .$target. $class. ' title="' .$oLink->title. '">' . $text . '</a>';

		return $html;
	}

	public function cutString( $strin, $length=50, $wildcard=' [...]' ){
		return substr( $strin, 0, ( strlen( $strin )<=$length ?  
			$length : strrpos( substr( $strin, 0, $length ), ' ' ) ) ) . ( strlen( $strin )>$length ? $wildcard:'' ) ;
		
	}

}?>