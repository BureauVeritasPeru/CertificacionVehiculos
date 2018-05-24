<?php
class UI_WebSite{

var $pageTitle;
var $metaTag;

var $oContentLang;
var $oSectionLang;
var $contentID;
var $sectionID;
var $langID;
var $staticURL;

var $module;
var $arrParent;
var $lContentPath;
var $Command;
var $UsrSession;
var $msgError;
	
    function __construct($staticURL, $contentID, $sectionID, $langID, $Command){

        $this->staticURL	=$staticURL;
        $this->contentID	=$contentID;
        $this->sectionID	=$sectionID;
        $this->langID		=$langID;

        $this->Command		=$Command;
        $this->module		="home"; // Default Module
        $this->UsrSession	=(isset($_SESSION["liteCMS_STM_WEB"])) ? $_SESSION["liteCMS_STM_WEB"] : NULL;
        $this->arrParent	=array();
        $this->lContentPath	=new Collection();

        $this->pageTitle	=SEO::get_SiteName();
        $this->metaTag		=array('title'=>'', 'description'=>'', 'keywords'=>'');

        if($this->staticURL!=NULL)
                $this->loadStaticURL();
        else
                $this->loadContentID();

        if($this->oContentLang!=NULL){

                $this->validatePage();//verify template type

                $this->sectionID	=$this->oContentLang->sectionID;
                $this->langID		=$this->oContentLang->langID;

                $parentID=$this->oContentLang->parentContentID;
                while(intval($parentID)>0){
                        $this->arrParent[]= $parentID;
                        $oParent=CmsContentLang::getItem($parentID, $this->langID);
                        $this->lContentPath->addItem($oParent, $parentID);
                        $parentID=$oParent->parentContentID;
                }
                $this->lContentPath->sortKeys();
        }else{
            if(!isset($this->oSectionLang) || !$this->oSectionLang->showContent) $this->oSectionLang=NULL; //Fix for Home Page
        }

        $this->setPageHeaders();
    }

    function loadStaticURL(){
    global $WEBSITE;

        $arrUrl=explode("/", $this->staticURL);
        if(count($arrUrl)>1 || count($arrUrl)>2){ //validar para el caso de minisites
                $this->oContentLang = CmsContentLang::getWebItem_StaticURL($this->staticURL);
                if($this->oContentLang!=NULL){
                        $this->oSectionLang =CmsSectionLang::getWebItem( $this->oContentLang->sectionID, $this->langID );
                }
        }
        else{
                $this->oSectionLang = CmsSectionLang::getWebItem_StaticURL($this->staticURL);
        }
        
        //error 404
        if(count($arrUrl)>0 && $this->oContentLang==NULL && $this->oSectionLang==NULL){
            header('location: '.SEO::get_URLRoot().'error?error=404');
        }
    }

    function loadContentID(){
        if(isset($this->contentID) && isset($this->langID)){
            $this->oContentLang = CmsContentLang::getWebItem($this->contentID, $this->langID);
            if($this->oContentLang!=NULL){
                $this->oSectionLang =CmsSectionLang::getWebItem( $this->oContentLang->sectionID, $this->langID );
            }
        }
        else{
            $this->oSectionLang = CmsSectionLang::getItem($this->sectionID, $this->langID);
        }
    }

    function setPageHeaders(){
        $this->pageTitle     =SEO::get_SiteName();
        $this->metaTag        =array('title'=>'', 'description'=>'', 'keywords'=>'');

        if(isset($this->oContentLang)){
            $this->pageTitle .=": ".$this->oContentLang->title;
            $this->metaTag    =XMLParser::getArray($this->oContentLang->metaTag);
            $this->module     ="content";// Content Module
        }
        else{
            $oSection=isset($this->oSectionLang)? $this->oSectionLang: CmsSectionLang::getWebItem(1, $this->langID); //Home Page
            $this->metaTag    =XMLParser::getArray($oSection->metaTag);
            $this->module     =($oSection->sectionID>1)? "section": "home"; // Section Module
        }
    }

    function validatePage(){
        switch($this->oContentLang->templateID){
        case 3: //Subnivel
            $lChild=CmsContentLang::getWebList($this->oContentLang->contentID, $this->oContentLang->sectionID, $this->oContentLang->langID);
            if($lChild->getLength()>0){
                $oItem=$lChild->getItem(0);
                header('location: '.SEO::get_URLContent($oItem));
                exit;
            }
            break;
        case 30: //Cambio de Idioma
            $param=XMLParser::getArray($this->oContentLang->parameter);
            if(isset($param['langID'])){
                header('location: '.SEO::get_URLHome().'?lID='.$param['langID']);
                exit;
            }
            break;
        }
    }

    function getFormView(){

        if($this->oContentLang!=NULL){
                $oSchema=CmsSchema::getItem($this->oContentLang->schemaID);
                $contentView='cms/'.$oSchema->webSource.'.php'; // Content Template
        }else{
                $contentView='index.php'; // Default view
        }

        return $contentView;
    }

    function addError($strErr){
        if($strErr=="") return;

        $this->msgError.="<li>".$strErr."</li>\n";
    }

    function getErrorMessage(){
        return $this->msgError;
    }

    function getPaging($DAO){
        $pageSize=$DAO::GetPageCount();
        $thisPage=$DAO::$page/$DAO::$limit;
        $maxPages=4;

        $paginado=NULL;
        if ($pageSize>1) {
            $rowCount=CmsContentLang::GetTotalRows();
            $paginado='<div class="divPaginado"><span>P&aacute;gina '.($thisPage+1).' de '.$pageSize.'</span>';

            $j=floor($thisPage/$maxPages)*$maxPages;
            if($thisPage>=$maxPages) $paginado.='<a href="#" rel="'.($j-1).'"> < </a><a href="#" rel="0">1</a>...';
            for ($i=0;$i<$maxPages;$i++){
                $paginado.= '<a href="#" rel="'.$j.'" '.($j==$thisPage?'class="selecto"':'').'>'.($j+1).'</a>';
                if(($j+1)>=$pageSize) break;
                $j++;
            }
            if(($thisPage+1)<$pageSize) $paginado.='...<a href="#" rel="'.($j).'">'.$pageSize.'</a><a href="#" rel="'.($thisPage+1).'"> > </a>';

            $paginado.= '</div>';
        } 	

        return $paginado;
    }

}

?>