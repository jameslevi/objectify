<?php

namespace Objectify;

class Objectify
{
    /**
     * Contains the current version of objectify.
     * 
     * @var string
     */

    private static $version = "v1.0.0";

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

    public function __construct(array $data = [], bool $locked = false)
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

    public function getKeys()
    {
        return array_keys($this->data);
    }

    /**
     * Return true if key exists from data array.
     * 
     * @param   string $key
     * @return  bool
     */

    public function exist(string $key)
    {
        return (bool) array_key_exists($key, $this->data);
    }

    /**
     * Return data by key.
     * 
     * @param   string $key
     * @return  mixed
     */

    public function __get(string $key)
    {
        if($this->exist($key))
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
        if($this->isLocked())
        {
            return;
        }

        if($this->exist($key))
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
        if($this->isLocked())
        {
            return $this;
        }

        if(!$this->exist($key))
        {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * Remove a property from the data object.
     * 
     * @param   string $key
     * @return  $this
     */

    public function remove(string $key)
    {
        if($this->isLocked())
        {
            return $this;
        }

        if($this->exist($key))
        {
            unset($this->data[$key]);
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
     * @return  \Objectify\Objectify
     */

    public function clone()
    {
        return new self($this->toArray());
    }

    /**
     * Objectify class factory.
     * 
     * @param   array $data
     * @param   bool $locked
     * @return  $this
     */

    public static function make(array $data = [], bool $locked = false)
    {
        return new self($data, $locked);
    }

    /**
     * Return the current version of objectify.
     * 
     * @return  string
     */

    public static function version()
    {
        return self::$version;
    }

}