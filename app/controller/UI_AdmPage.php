<?php

class UI_AdmPage{
var $moduleID;
var $menuID;
var $parentMenuID;
var $moduleName;
var $moduleForm;
var $moduleParams;
var $FormView;
var $FormTitle;
var $ItemTitle;
var $Command;
var $StaticDAO;

var $UsrSession;
var $lUserEvents;
var $Page;
var $OrderBy;

var $clientScript;
var $msgError;
var $msgAlert;

var $urlContent;

    function UI_AdmPage($moduleID, $FormView, $Command){
    global $ADMIN;

        $oModule=AdmModule::getItem($moduleID);
        if($oModule!=null){
            $this->moduleID	=$oModule->moduleID;
            $this->moduleName   =$oModule->moduleName;
            $this->moduleIcon   =$oModule->moduleIcon;
            $this->moduleForm	=$oModule->moduleForm;
            $this->moduleParams	=$oModule->moduleParams;
            $this->menuID	=$oModule->menuID;
            $this->parentMenuID	=$this->getParentMenuID($oModule->menuID);
        }
        else
            return false;

        $this->FormView     =(isset($FormView))?$FormView:'list';
        $this->Command      =$Command;
        $this->loadSessionUser();
    }

    function loadSessionUser(){
        $this->UsrSession   =isset($_SESSION[ADM_SESSION_ID])? unserialize($_SESSION[ADM_SESSION_ID]): NULL;
        $this->lUserEvents  =(isset($this->UsrSession->lUserEvents)) ? $this->UsrSession->lUserEvents : null;
    }
    
    function GetCommandEvent(){

        switch($this->Command){
            case 'insert':
            case 'update':
            case 'moveUp':
            case 'reorder':
            case 'delete': $command = 'ADMINISTRAR'; break;
            case 'send':
            case 'list':
            case '': $command='LISTAR'; break;
            default: $command = strtoupper($this->Command); break;
        }

        return $command;
    }

    function ValidateEvent($command){

        if($this->lUserEvents == null || $this->lUserEvents->getLength()==0){
            $this->addError('No tiene acceso a este m&oacute;dulo, permiso denegado.');
            return false;
        }

        //var_dump($this->lUserEvents);
        foreach($this->lUserEvents as $oEvent){
            if($oEvent->moduleID == $this->moduleID && $oEvent->command == $command){
                return true;
            }
        }

        return false;
    }

    function getEvent($command){

        if($this->lUserEvents == null || $this->lUserEvents->getLength()==0){
            return null;
        }
        
        $command=$this->GetCommandEvent($this->Command);

        foreach($this->lUserEvents as $oEvent){
            if($oEvent->moduleID == $this->moduleID && $oEvent->command == $command){
                return $oEvent;
            }
        }

        return null;
    }

    function getParentMenuID($menuID){

        $oMenu=AdmMenu::getItem($menuID);
        if($oMenu!=null){
            $menuID= ($oMenu->parentMenuID>0) ? $this->getparentmenuID($oMenu->parentMenuID): $oMenu->menuID;
        }
        return $menuID;
    }

    function processFormAction($DAO, $oItem){

        $this->StaticDAO=$DAO;
        $DAO::$page	=$this->Page;
        $DAO::$orderBy	=$this->OrderBy;

        if(!$this->ValidateEvent('ADMINISTRAR')){
            $this->addAlert('Acceso limitado, su perfil solo tiene permisos de lectura.');
            $this->addClientScript('var userReadOnly=true;');
        }

        if(!$this->ValidateEvent($this->GetCommandEvent($this->Command))){
            $this->addError('No puede realizar esta acci&oacute;n, permiso denegado.');
            return;
        }

        if($this->FormView=='xls'){
            header('Content-Type: application/vnd.ms-excel');	
            header('Content-Disposition: attachment; filename=\''.$this->moduleName.'.xls\';' );
        }

        $comment=NULL;
        switch($this->Command){
            case 'delete':
                $DAO::Delete($oItem);
                $comment='El usuario elimin&oacute; el registro';
                break;
            case 'insert':
                if ($DAO::AddNew($oItem)){
                    $comment='El usuario insert&oacute; el registro';
                    $this->FormView='list';
                }
                break;
            case 'update':
                if ($DAO::Update($oItem)){
                    $comment='El usuario actualiz&oacute; el registro';
                    $this->FormView='list';
                }
                break;
        }
        
        $this->registerLog($comment, $oItem);
        $this->addError($DAO::GetErrorMsg());
    }

    function registerLog($message, $obj=NULL){

        $oEvent=$this->getEvent($this->Command);
        if($oEvent!=NULL && $oEvent->regEvent){
            $oAdmLog=new eAdmLog();
            $oAdmLog->userID=$this->UsrSession->userID;
            $oAdmLog->eventID=$oEvent->eventID;
            $oAdmLog->comment=$message;
            if(isset($obj)) $oAdmLog->object=serialize($obj);
            
            AdmLog::AddNew($oAdmLog);
        }
    }

    function getFormView(){

        switch($this->FormView){
            case '':
            case 'list':
                    $strForm='list.php';
                    break;
            case 'edit':
            case 'add':
                    $strForm='form.php';
                    break;
            default:
                    $strForm=$this->FormView.'.php';
                    break;
        }

        return $this->moduleForm.'.'.$strForm;
    }

    function getFormTitle(){

        switch($this->FormView){
            case '':
            case 'list':
                    $title='Listado';
                    break;
            case 'add':
                    $title='Nuevo';
                    break;
            case 'edit':
                    $title='Editar';
                    break;
            case 'view':
                    $title='Detalle';
                    break;
            case 'section':
                    $title='Editar Secci&oacute;n';
                    break;
            case 'sort':
                    $title='Ordenar Lista';
                    break;
            default:
                    $title=$this->FormView;
                    break;
        }

        if($this->FormTitle!='') $title.=' - '.$this->FormTitle;
        if($this->ItemTitle!='') $title.=': '.$this->ItemTitle;

        return $title;
    }

    function getURL($params=''){
        if(!isset($this->urlContent)){
            $url=SEO::get_URLAdmin().'?moduleID='.$this->moduleID;
            $url.=($this->moduleParams!='' ? '&'.$this->moduleParams : '');
            $url.=($params!='' ? '&'.$params : '');
            $this->urlContent=$url;
        }

        return $this->urlContent;
    }

    function addError($msg){
        if($msg=='') return;

        $this->msgError.='<div class="cms_msg">'.$msg.'</div>'."\n";
    }

    function addAlert($msg){
        if($msg=='') return;

        $this->msgAlert.='<div class="cms_msg">'.$msg.'</div>'."\n";
    }

    function addClientScript($script){
        if($script=='') return;

        $this->clientScript.=$script.'\n';
    }

    function getSortingHeader($field, $title){

        $arrOrder =  explode(' ', $this->OrderBy);
        $sortType = 'asc';
        $icon='';

        if($arrOrder[0]==$field){
                $sortType=($arrOrder[1]=='desc') ? 'asc' : 'desc';
                $icon='<i class="fa fa-sort-'.$arrOrder[1].' visible-md visible-lg"></i>';
        }

        $sortOrder="$field $sortType";

        return '<a href="javascript:OrderBy(\''.$sortOrder.'\')">'.$title.'</a>'.$icon;
    }

    function getPaging(){
        $DAO=$this->StaticDAO;
        $pageCount=$DAO::GetPageCount();

        $xlink='';


        if ($pageCount>1) {
            $xlink='<ul class="pagination pagination-sm no-margin pull-right">';

            $j=floor($this->Page/10)*10;
            if($this->Page>=10) $xlink.='<li><a href="javascript:MovePg('.($j-1).')">&laquo;</a></li>';
            for ($i=0;$i<10;$i++){
                if($j==$this->Page)
                    $xlink.= '<li class="active"><a href="#">'.($j+1).'</a></li>';
                else
                    $xlink.= '<li><a href="javascript:MovePg('.$j.')">'.($j+1).'</a></li>';

                if(($j+1)>=$pageCount) break;
                $j++;
            }

            if(($this->Page+1)<$pageCount && $pageCount>10) $xlink.='<li><a href="javascript:MovePg('.$j.')">&raquo;</a></li>';
       
               $xlink.= '</ul>';

        } 	

        return $xlink;



       $pageCount=parent::GetPageCount();

        $paging='';
        if ($pageCount>1) {
            $paging='<ul class="pagination pagination-sm no-margin pull-right">';

            $j=floor($page/10)*10;

            if($page>=10) $paging.='<li><a href="javascript:MovePg('.($j-1).')">&laquo;</a></li>';

            for ($i=0;$i<10;$i++){
                if($j==$page)
                $paging.= '<li><a href="javascript:void(0)" class="active">'.($j+1).'</a></li>';
                else
                $paging.= '<li><a href="javascript:MovePg('.$j.')">'.($j+1).'</a></li>';

                if(($j+1)>=$pageCount) break;
                $j++;
            }

            if(($page+1)<$pageCount && $pageCount>10) $paging.='<li><a href="javascript:MovePg('.$j.')">&raquo;</a></li>';
        

        }   

               $paging.= '</ul>';
        return $paging;



    }

}

?>