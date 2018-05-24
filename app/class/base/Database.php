<?php
/**************************************************************************************************************/

class Database
{
	//****** ATRIBUTOS *********
	private static $link;
	private static $affected_rows=0;
	private static $_rowCount=0;
	private static $_errorMsg="";
	private static $_pageCount=0;
	private static $_identity=0;
	
	public static $page=0;
	public static $orderBy="";
	public static $limit=10;

	private function __costruct(){
		
	}

	private static function Open(){

		$host	=ConfigParam::getparam("MYSQL_HOST");
		$user	=ConfigParam::getparam("MYSQL_USER");
		$pwd	=ConfigParam::getparam("MYSQL_PWD");
		$db		=ConfigParam::getparam("MYSQL_DB");

		self::$link = @mysqli_connect($host, $user, $pwd, $db);
		if (!self::$link) {
			die('Could not connect: ' . mysqli_error());
			return false;
		}
		else {
			@mysqli_set_charset(self::$link, "utf8");
			return self::$link;
		}
	}
	
	private static function Close(){
		mysqli_close(self::$link);
	}
	
	protected static function GetLasIdentity(){
		return self::$_identity;
	}

	protected static function GetCollection($result){
		$clsEntity='e'.get_called_class();
		$list=new Collection();
		while ($row = self::fetchArray($result)) {
			$list->addItem(self::ParseEntityRow(new $clsEntity, $row));
		}
		//mysqli_free_result($result);
		return $list;
	}

	protected static function GetObject($result){
		$clsEntity='e'.get_called_class();
		$obj=NULL;
		if ($row = self::fetchArray($result)){
			$obj=self::ParseEntityRow(new $clsEntity, $row);
		}
		//mysqli_free_result($result);
		return $obj;
	}
	
	private static function ParseEntityRow($obj, $row){
		$vars=get_object_vars($obj);
		foreach($vars as $key=>$val){
			if(isset($row[$key])) $obj->$key=$row[$key];
		}
		return $obj;
	}
	
	protected static function GetResult($query){
		if ($query=="") return false;
		//echo "(".$query.")";

		//Ejecuta el query
		$result = @mysqli_query(self::Open(), $query);
		if (!$result)
			self::SetErrorMsg(mysqli_error(self::$link).". ");
		else
			self::$affected_rows=@mysqli_affected_rows();

		self::Close();
		return $result;
	}

	protected static function GetResultPaging($query){
		if ($query=="") return false;

		if(self::$orderBy!="") $query.=" ORDER BY ".(self::$orderBy);

		// self::setPaging($query);
		// $query = $query." LIMIT ".(self::$page).", ".(self::$limit);
		//echo "(".$query.")";

		//Ejecuta el query
		$result = @mysqli_query(self::Open(), $query);
		if (!$result)
			self::SetErrorMsg(mysqli_error(self::$link).". ");
		else
			self::$affected_rows=@mysqli_affected_rows();

		self::Close();
		return $result;
	}
	
	protected static function Execute($query){
		if ($query=="") return false;

		//Ejecuta el query
		$result = @mysqli_query(self::Open(), $query);
		if (!$result)
			self::SetErrorMsg(mysqli_error(self::$link).". ");
		else
			self::$affected_rows=@mysqli_affected_rows();

		self::$_identity=mysqli_insert_id(self::$link);
		self::Close();
		return (self::GetErrorMsg()=="");
	}
	
	public static function SetErrorMsg($error){
		self::$_errorMsg=self::$_errorMsg.$error;
	}
	
	public static function GetErrorMsg(){
		return self::$_errorMsg;
	}

	public static function GetPageCount(){
		return self::$_pageCount;
	}

	public static function GetTotalRows(){
		return self::$_rowCount;
	}

	public static function Exist($result){
		if(!$result) return false;
		return (@mysqli_num_rows($result)>0? true: false);
	}

	public static function Count($result){
		if(!$result) return NULL;
		return @mysqli_num_rows($result);
	}

	protected static function AffecctedRows(){
		return self::$affected_rows;
	}

	protected static function fetchArray($result){
		if(!$result) return NULL;
		return mysqli_fetch_array($result);
	}
	
	protected static function fetchScalar($result){
		if ($row = self::fetchArray($result)){
			return $row[0];
		}
		return NULL;
	}

	public static function getFormatDate($strDate, $format){
		$new_date=strtotime($strDate);
		return date($format, $new_date);
	}

	public static function getActive($active){
		switch($active){
			case 1:
			return "Activo"; break;
			case 0:
			return "Inactivo"; break;
		}
	}

	private static function setPaging($query) {
		$result=@mysqli_query(self::Open(), $query);
		self::$_rowCount=self::Count($result);

		$page 	= (self::$page * self::$limit);
		$counter= floor((self::$_rowCount/self::$limit));

		if((self::$_rowCount % self::$limit)>0) $counter++;
		if($page>($counter*self::$limit)) $page-=self::$limit;

		self::$_pageCount=$counter;
		self::$page = $page;
	}


}
?>                