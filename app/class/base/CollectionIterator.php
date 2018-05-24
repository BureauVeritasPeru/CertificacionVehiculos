<?php

require_once 'Collection.php';

class CollectionIterator implements Iterator
{

    protected $_collection;
    protected $_index;
    protected $_keys;

    public function __construct(Collection $col)
    {
        $this->_collection = $col;
        $this->_index = 0;
        $this->_keys = $col->getKeys();
    }

    public function rewind()
    {
        $this->_index = 0;
    }

    public function valid()
    {
        return $this->_index < $this->_collection->getLength();
    }

    public function key()
    {
        return $this->_keys[$this->_index];
    }

    public function current()
    {
        return $this->_collection->getItem($this->_keys[$this->_index]);
    }

    public function next()
    {
        $this->_index++;
    }

}

?>