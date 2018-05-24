<?php
class SEO{

    public static function get_URLRedirect($contentID, $langID){
    global $WEBSITE;
        if($contentID=='') return self::get_URLHome();

        $oContent   =CmsContentLang::getItem( $contentID, $langID );
        if($oContent==NULL) return self::get_URLHome();
    
        if($WEBSITE['STATIC_URL'])
            return self::get_URLRoot().$oContent->staticURL.'.html';
        else
            return self::get_ContentPage().'?pID='.$oContent->contentID;

    }

    public static function get_URLContent($oContent, $params=NULL){
    global $WEBSITE;
    
        if($WEBSITE['STATIC_URL'] && $oContent->staticURL!='')
            return self::get_URLRoot().$oContent->staticURL.'.html'.($params!=NULL?'?'.$params:'');
        else
            return self::get_ContentPage().'?pID='.$oContent->contentID.($params!=NULL?'&'.$params:'');
    }

    public static function get_URLSection($oSection){
    global $WEBSITE;
        if($WEBSITE['STATIC_URL'] && $oSection->staticURL!='')
            return self::get_URLRoot().$oSection->staticURL.'.html';
        else
            return self::get_ContentPage().'?sID='.$oSection->sectionID;
    }

    public static function get_URLSeminuevos($langID){
        $templateID=21;
        $sectionID=7;
        $ltmp=CmsContentLang::getWebList_Template($templateID, $sectionID, $langID);

        return $ltmp->getLength()>0? SEO::get_URLContent($ltmp->getItem(0)): NULL;
    }

    public static function parse_URLRelative($urlRelative){
    
        return self::get_URLRoot().str_replace('../', '', $urlRelative);
    }

    public static function get_Domain(){
        return $_SERVER['SERVER_NAME'];
    }
    
    public static function get_SiteName(){
    global $WEBSITE;
    
        return $WEBSITE['SITE_NAME'];
    }

    public static function get_URLRoot(){
    global $WEBSITE;
    
        return $WEBSITE['ROOT'];
    }

    public static function get_PublicFolder(){
    global $WEBSITE;
    
        return $WEBSITE['PUBLIC_FOLDER'];
    }
    
    public static function get_URLBase(){
    global $WEBSITE;
    
        return self::get_URLRoot().'assets/website/';
    }

    public static function get_URLAdmin(){
    global $WEBSITE;
    
        return self::get_URLRoot().'admin/';
    }

    public static function get_URLAssets(){
    global $WEBSITE;
    
        return self::get_URLRoot().'assets/';
    }

    public static function get_URLHome(){
    global $WEBSITE;
    
        if($WEBSITE['STATIC_URL'])
            return self::get_URLRoot();
        else
            return self::get_ContentPage();
    }
    
    public static function get_HTTPSite($https=false){
    global $WEBSITE;
    
        return 'http'.($https?'s':'').'://'.self::get_Domain().self::get_URLRoot();
    }

    public static function get_HTTPAssets($https=false){
    global $WEBSITE;
    
        return 'http'.($https?'s':'').'://'.self::get_Domain().self::get_URLAssets();
    }

    public static function get_HTTPAdmin($https=false){
    global $WEBSITE;
    
        return self::get_HTTPSite($https).'admin';
    }

    public static function get_ContentLink($oContentLang, $params=NULL){
        //Retrive properties
        $oLink=new eLink();
        $oLink->url='#';
        
        if($oContentLang==NULL) return $oLink;

        $oLink->text=$oContentLang->title;
        $oLink->title=$oContentLang->title;
        
        switch($oContentLang->linkType){
            case 0:
                $oLink->url=$oContentLang->isPage? SEO::get_URLContent($oContentLang): '#';
                break;
            case 1:
                $oLink->url=SEO::get_URLRedirect($oContentLang->linkContentID, $oContentLang->langID);
                break;
            case 2:
                $oLink->url=$oContentLang->linkURL;
                $allowed_chars='[a-z0-9\/:_\-_\.\?\$,~=#&%\+@]';
                if(!preg_match('/^((http|https|ftp):\/\/)|(mailto:)'. $allowed_chars .'+$/i', strtolower($oLink->url))) $oLink->url='http://'.$oLink->url;
                $oLink->target ='_blank';
                break;
            //case 3:
            //  $oLink->url='index.php?swID='.$oContentLang->linkContentID; break;
        }
        
        if($params!=NULL) $oLink->url.=(strstr($oLink->url, '?')?'&':'?').$params;

        return $oLink;
    }

    /*Private methods*/
    private static function get_ContentPage(){
        return self::get_URLRoot().'index.php';
    }

}
?>