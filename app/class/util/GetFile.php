<?php
class GetFile
{
	public static $ext ='pdf,doc,docx';

	public static function Read( $f )
	{
		$ext =explode( ',', self::$ext )  ;
		
		$ftmp 	=explode( '.',$f);
		$fExt 	=strtolower($ftmp[count($ftmp)-1]);
		$filetmp=explode( '/',$f);  
		$file	=strtolower($filetmp[count($filetmp)-1]);		

		if( ! in_array( $fExt, $ext ) )
			die( '<b>ERROR!</b> no es posible descargar archivos con la extensión' . $fExt );

		header( 'Content-type: application/pdf' ) ;
		header( 'Content-Disposition: attachment; filename=' . $file ) ;
		header( 'Content-Length: '.filesize($f) ) ;
		
		readfile($f);
	}
}
?>