<?php
require_once 'CollectionIterator.php';

class CollectionException extends Exception {}

class Collection implements IteratorAggregate
{

    protected $_items = array();

    protected $_onLoad;
    protected $_isLoaded = false;

    public function getIterator()
    {
        return new CollectionIterator($this);
    }

    public function addItem($obj, $key = null)
    {
        $this->_checkCallback();
        if (!is_null($key)) {
            if (!isset($this->_items[$key])) {
                $this->_items[$key] = $obj;
            } else {
                throw new CollectionException('The key already exists.');
            }
        } else {
            $this->_items[] = $obj;
        }
    }

    public function removeItem($key)
    {
        $this->_checkCallback();
        if (isset($this->_items[$key])) {
            unset($this->_items[$key]);
        } else {
            throw new CollectionException('Incorrect key.');
        }
    }

    public function getItem($key)
    {
        $this->_checkCallback();
        if (isset($this->_items[$key])) {
            return $this->_items[$key];
        } else {
            throw new CollectionException('Incorrect key.');
        }
    }

    public function getLength()
    {
        $this->_checkCallback();
        return sizeof($this->_items);
    }

    public function getKeys()
    {
        $this->_checkCallback();
        return array_keys($this->_items);
    }

    public function sortKeys($asc=TRUE)
    {
        $this->_checkCallback();
		if(!$asc)
	        return arsort($this->_items);
		else
	        return asort($this->_items);
    }


    public function isExist($key)
    {
        $this->_checkCallback();
        return isset($this->_items[$key]);
    }

    public function setCallback($functionName, $owner = null)
    {
        if (!is_null($owner)) {
            $callback = array($owner, $functionName);
        } else {
            $callback = $functionName;
        }
        if (!is_callable($callback, false, $callableName)) {
            throw new CollectionException('Invalid callback function.');
        }
        $this->_onLoad = $callback;
    }

    protected function _checkCallback()
    {
        if (isset($this->_onLoad) && !$this->_isLoaded) {
            $this->_isLoaded = true;
            call_user_func($this->_onLoad, $this);
        }
    }

	public static function objectToString($obj){
		$str_fields="";
		$vars=get_object_vars($obj);
		foreach($vars as $key=>$val){
			if($str_fields!="") $str_fields.=", ";
			$str_fields.=$key."='".$val."'";
		}
		return $str_fields;
	}
}

?>