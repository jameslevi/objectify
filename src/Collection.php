<?php

namespace Graphite\Component\Objectify;

class Collection
{
    /**
     * Store rows of data object.
     * 
     * @var array
     */

    private $data = array();

    /**
     * Construct new collection instance.
     * 
     * @return  void
     */

    public function __construct() {}

    /**
     * Add new data object to collection.
     * 
     * @param   \Graphite\Component\Objectify\Objectify $object
     * @return  $this
     */

    public function add(Objectify $object)
    {
        $this->data[] = $object->setId('#item_' . $this->length());

        return $this;
    }

    /**
     * Remove data from collection.
     * 
     * @param   int $index
     * @return  $this
     */

    public function remove(int $index)
    {
        array_splice($this->data, $index, 1);

        return $this;
    }

    /**
     * Return data object by index.
     * 
     * @param   int $index
     * @return  \Graphite\Component\Objectify\Objectify
     */

    public function get(int $index)
    {
        return $this->data[$index];
    }

    /**
     * Return the first element from collection.
     * 
     * @return  \Graphite\Component\Objectify\Objectify
     */

    public function first()
    {
        return $this->get(0);
    }

    /**
     * Return the last element from collection.
     * 
     * @return  \Graphite\Component\Objectify\Objectify
     */

    public function last()
    {
        return $this->get($this->length() - 1);
    }

    /**
     * Return number of rows from collection.
     * 
     * @return  int
     */

    public function length()
    {
        return sizeof($this->data);
    }

    /**
     * If collection is empty.
     * 
     * @return  bool
     */

    public function empty()
    {
        return $this->length() == 0;
    }

    /**
     * Reverse the order of the collection.
     * 
     * @return  $this
     */

    public function reverse()
    {
        return array_reverse($this->data);
    }

    /**
     * Sort the collections in random order.
     * 
     * @return  $this
     */

    public function shuffle()
    {
        shuffle($this->data);
    
        return $this;
    }

    /**
     * Return collection as an array.
     * 
     * @return  array
     */

    public function toArray()
    {
        $data = array();

        foreach($this->data as $object)
        {
            $data[] = $object->toArray();
        }

        return $data;
    }

    /**
     * Return json formatted collection of data.
     * 
     * @return  string
     */

    public function toJson()
    {
        return json_encode($this->toArray());
    }

}