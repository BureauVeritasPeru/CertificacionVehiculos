<?php
class UploadHandler
{
	var $BASE_DIR = '';  // path to upload dir
	var $MAX_FILE_SIZE = 5242880; // 5Mb
	var $ERROR_MSG = '';  // Contains error messages
	var $AllowCreatingOfDirectoryStructure = true; // If UploadHandler should create missing directories
	var $BUILD_PATH='';
    
	function UploadHandler($BASE_DIR = false)
	{
		if ($BASE_DIR)
			$this->BASE_DIR = $BASE_DIR;
	}

	function ChangeDirectory($directory_name = '')
	{
		if (@chdir($this->BASE_DIR.$directory_name))
			return true;
		else
		{
			$this->ERROR_MSG .= ('No se puede cambiar al directorio '.$directory_name.'!<br>');
			return false;
		}
	}
  
	function CreateDirectoryStructure($directory_name, $ext_path)
	{
		$subdir = true;
		$total_path = $ext_path;
		$i=0;
		while($subdir)
		{
			$dirs[$i] = substr($total_path, 0, strpos($total_path, "/"));
			$total_path = substr($total_path, (strpos($total_path, "/") + 1), strlen($total_path));
			if (!isset($dirs[$i-1]) || $dirs[$i-1] == '')
				$dirs[$i-1] = '';
			else
				$dirs[$i-1] = '/'.$dirs[$i-1];
			$this->BUILD_PATH = $this->BUILD_PATH.$dirs[$i-1];
			$this->CreateDirectory( $directory_name.$this->BUILD_PATH, $dirs[$i]);
			if ($total_path == '')
				$subdir = false;
			$i++;
		}
		if (@is_dir($this->BASE_DIR.$directory_name.$ext_path))
			return true;
		else
			return false;
	}
  
	function CreateDirectory($directory_name, $ext_path)
	{
		if ($this->ChangeDirectory( $directory_name))
		{
			$oldumask = umask(0);
			if (@!is_dir($ext_path))
			{
				if (@mkdir($ext_path, 01777))
					return true;
				else
				{
					$this->ERROR_MSG .= ('Fall&oacute; la creaci&oacute;n del directorio '.$ext_path.'!');
					return false;
				}
			}
			else
				return true;
		}
		else
			return false;
	}
  
	function CheckDirectoryExistance($directory_name, $ext_path)
	{
		if (@is_dir($this->BASE_DIR.$directory_name.$ext_path))
			return true;
		else
			return false;
	}
  
  /*
   * $file              file to upload
   * $file_name         name of the file
   * $file_type         file type
   * $directory_name    directory path in where to put the uploaded file. This path will not be created! i.e. "images/gallery/"
   * $ext_path          extended path. This will be created if non existant and AllowCreatingOfDirectoryStructure is set to true i.e. "images/new/$date"
   *                    
   */
	function Upload($file, $file_name, $file_type,  $directory_name, $ext_path = '')
	{
		if (!$this->CheckDirectoryExistance($directory_name, $ext_path))
		{
			if ($this->CreateDirectoryStructure( $directory_name, $ext_path))
			{
				if ($this->receiveFile($file, $file_name, $file_type, $directory_name, $ext_path))
					return ($this->BASE_DIR.$directory_name.$ext_path);
				else
				{
					$this->ERROR_MSG .= ('Fall&oacute; la carga del archivo.');
					return false;
				}
			}
			else
			{
				$this->ERROR_MSG .= ('Fall&oacute; la creaci&oacute;n del directorio!');
				return false;
			}
		}
		else
		{
			if ($this->receiveFile($file, $file_name, $file_type, $directory_name, $ext_path))
				return ($this->BASE_DIR.$directory_name.$ext_path.$file_name);
			else
			{
				$this->ERROR_MSG .= ('Fall&oacute; la carga del archivo.');
				return false;
			}
		}
	}
  /*
   * Deletes target file
   */
	function DeleteFile($file_name, $directory_name, $ext_path = '')
	{
		if (unlink($this->BASE_DIR.$directory_name.$ext_path.$file_name))
			return true;
		else
			return false;
	}
  /*
   * Internal function. Receives the file from the Upload function.
   */
	function receiveFile($file, $file_name, $file_type, $directory_name, $ext_path)
	{
		if (copy($file, $this->BASE_DIR.$directory_name.$ext_path.$file_name))
		{
			if (move_uploaded_file($file, $this->BASE_DIR.$directory_name.$ext_path.$file_name))
			{
				if (chmod($this->BASE_DIR.$directory_name.$ext_path.$file_name, 0777))
					return true;
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}
}
?>