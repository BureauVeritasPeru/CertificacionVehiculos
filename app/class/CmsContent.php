<?php
require_once("base/Database.php");

class CmsContent extends Database
{

	public static function  getItem($contentID){
            $query = "SELECT contentID, parentContentID, schemaID, contentName, position
                            FROM cms_content
                            WHERE contentID='$contentID' ";

            return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT contentID, parentContentID, schemaID, contentName, position
		FROM cms_content
		ORDER BY contentID";
            return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oContent){
		//Search max Id
		$query = "SELECT MAX(contentID) FROM cms_content";
		$result = parent::GetResult($query);
		$oContent->contentID = parent::fetchScalar($result)+1;

		//Search last position
		$query = "SELECT COUNT(cont.position) FROM cms_content AS cont
			INNER JOIN cms_schema AS schm
				ON schm.schemaID=cont.schemaID
			WHERE 
                            IFNULL(cont.parentContentID,0) ='$oContent->parentContentID'
                            AND schm.sectionID='$oContent->sectionID'
                        ";
		$result = parent::GetResult($query);
		$oContent->position = parent::fetchScalar($result)+1;

		//Insert data to table
		TextParser::ParseEntityQuotes($oContent);
		$query = "INSERT INTO cms_content(contentID, parentContentID, schemaID, contentName, position)
				VALUES('$oContent->contentID', ".($oContent->parentContentID!=null ? $oContent->parentContentID: "null").", '$oContent->schemaID', '$oContent->contentName', '$oContent->position')";
		return parent::Execute($query);
	}

	public static function  MoveUp($oContent){
		//Search Previous Id
		$query = "SELECT cont.contentID, cont.parentContentID, cont.schemaID, cont.contentName, cont.position 
		FROM cms_content AS cont
		INNER JOIN cms_schema AS schm  ON schm.schemaID=cont.schemaID
		WHERE 
		IFNULL(cont.parentContentID,0) ='$oContent->parentContentID'  AND
		schm.sectionID  = '$oContent->sectionID' AND 
		cont.contentID <> '$oContent->contentID' AND
		cont.position < '$oContent->position'
		ORDER BY cont.position DESC
		LIMIT 0, 1";
		//echo $query."|";
		$result = parent::GetResult($query);
		if($row = parent::fetchArray($result)){
			$oContentPrev =new eCmsContent($row['contentID'], $row['parentContentID'], $row['schemaID'], $row['contentName'], $row['position']);
			
			//Update Position: Previous Item
			$query = "UPDATE cms_content SET 
					position='$oContent->position'
				WHERE contentID='$oContentPrev->contentID'";
			//echo $query."|";
			if(parent::Execute($query)){
				//Update Position: Current Item
				$query = "UPDATE cms_content SET 
						position='$oContentPrev->position'
					WHERE contentID='$oContent->contentID'";
				//echo $query."|";
				return parent::Execute($query);
			}
		}
		
		return false;
	}
        
        public static function  UpdatePositionList($aItems){
            //Update position lis from schemme
            foreach ($aItems as $position=>$contentID){
		$query = "UPDATE cms_content SET 
                            position = '$position'
			WHERE contentID = '$contentID'";
		if(!parent::Execute($query)) return false;
            }
            return true;
	}


	public static function  Update($oContent){
		//Update data to table
		$query = "UPDATE cms_content SET 
                            contentName = '$oContent->contentName'
			WHERE contentID = '$oContent->contentID'";
		return parent::Execute($query);
	}

	public static function  Delete($oContent){
		$query = "DELETE FROM cms_content WHERE contentID='$oContent->contentID'";
		parent::Execute($query);
	}

}

?>