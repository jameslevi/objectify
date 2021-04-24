<?php

namespace Graphite\Component\Objectify;

class Objectify
{
    /**
     * Store object data.
     * 
     * @var array
     */

    private $data = array();

    /**
     * Determine if data object is locked.
     * 
     * @var bool
     */

    private $locked = false;

    /**
     * Construct a new objectify object.
     * 
     * @param   array $data
     * @param   bool $locked
     * @return  void
     */

    public function __construct(array $data, bool $locked = false)
    {
        $this->data     = $data;
        $this->locked   = $locked;
    }

    /**
     * Determine if data object is locked and cannot be updated.
     * 
     * @return  bool
     */

    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * Determine if data object is empty.
     * 
     * @return  bool
     */

    public function empty()
    {
        return empty($this->data);
    }

    /**
     * Return a list of all property keys.
     * 
     * @return  array
     */

    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * Return true if data object has key.
     * 
     * @param   string $key
     * @return  bool
     */

    public function has(string $key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Return data as object property.
     * 
     * @param   string $key
     * @return  mixed
     */

    public function __get(string $key)
    {
        return $this->get($key);
    }

    /**
     * Return data by key.
     * 
     * @param   string $key
     * @return  mixed
     */

    public function get(string $key)
    {
        if($this->has($key))
        {
            return $this->data[$key];
        }
    }

    /**
     * Update the value of a property by key.
     * 
     * @param   string $key
     * @param   mixed $value
     * @return  void
     */

    public function __set(string $key, $value)
    {
        if($this->has($key) && !$this->isLocked())
        {
            $this->data[$key] = $value;
        }
    }

    /**
     * Add new property to the data object.
     * 
     * @param   string $key
     * @param   mixed $value
     * @return  $this
     */

    public function add(string $key, $value)
    {
        $key = strtolower($key);

        if(!$this->has($key) && !$this->isLocked())
        {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * Remove a property from the data object.
     * 
     * @param   mixed $key
     * @return  $this
     */

    public function remove($key)
    {
        if(!$this->isLocked())
        {
            if(is_string($key))
            {
                $key = [$key];
            }

            foreach($key as $index)
            {
                if($this->has($index))
                {
                    unset($this->data[$index]);
                }
            }
        }

        return $this;
    }

    /**
     * Return stored array of data.
     * 
     * @return  array
     */

    public function toArray()
    {
        return $this->data;
    }

    /**
     * Return json formatted data.
     * 
     * @return  string
     */

    public function toJson()
    {
        return json_encode($this->data);
    }

    /**
     * Return an exact copy of this object.
     * 
     * @return  \Graphite\Component\Objectify\Objectify
     */

    public function clone()
    {
        return new self($this->toArray(), $this->isLocked());
    }

    /**
     * Merge two data object into one data object.
     * 
     * @param   \Graphite\Component\Objectify\Objectify
     * @param   bool $override
     * @return  $this
     */

    public function merge(Objectify $object, bool $override = false)
    {
        foreach($object->keys() as $key)
        {
            if(!$this->has($key))
            {
                $this->add($key, $object->get($key));
            }
            else
            {
                if($override)
                {
                    $this->{$key} = $object->get($key);
                }
            }
        }

        return $this;
    }

    /**
     * Determine if data object has the same data structure.
     * 
     * @param   \Graphite\Component\Objectify\Objectify $object
     * @return  bool
     */

    public function equals(Objectify $object)
    {
        $a = $this->keys();
        $b = $object->keys();

        return array_diff($a, $b) == array_diff($b, $a);
    }

    /**
     * Objectify class factory.
     * 
     * @param   array $data
     * @param   bool $locked
     * @return  $this
     */

    public static function make(array $data, bool $locked = false)
    {
        return new self($data, $locked);
    }

}