<?php

namespace Graphite\Component\Objectify;

class Objectify
{
    /**
     * Current version of objectify.
     * 
     * @var string
     */
    private static $version = "v1.0.2";

    /**
     * Store object data.
     * 
     * @var array
     */
    private $data = array();

    /**
     * Determine if data object is muted.
     * 
     * @var bool
     */
    private $muted = false;

    /**
     * Construct a new objectify object.
     * 
     * @param   array $data
     * @param   bool $muted
     * @return  void
     */
    public function __construct(array $data, bool $muted = false)
    {
        $this->data     = $data;
        $this->muted    = $muted;
    }

    /**
     * Determine if data object is muted.
     * 
     * @return  bool
     */
    final public function isMuted()
    {
        return $this->muted;
    }

    /**
     * Determine if data object is empty.
     * 
     * @return  bool
     */
    final public function empty()
    {
        return empty($this->data);
    }

    /**
     * Return a list of all property keys.
     * 
     * @return  array
     */
    final public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * Return true if data object has key.
     * 
     * @param   string $key
     * @return  bool
     */
    final public function has(string $key)
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
    final public function get(string $key)
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
        $this->set($key, $value);
    }

    /**
     * Update the value of a data object property.
     * 
     * @param   string $key
     * @param   mixed $value
     * @return  $this
     */
    final public function set(string $key, $value)
    {
        if($this->has($key) && !$this->isMuted())
        {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * Add new property to the data object.
     * 
     * @param   string $key
     * @param   mixed $value
     * @return  $this
     */
    final public function add(string $key, $value)
    {
        $key = strtolower($key);

        if(!$this->has($key) && !$this->isMuted())
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
    final public function remove($key)
    {
        if(!$this->isMuted())
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
    final public function toArray()
    {
        return $this->data;
    }

    /**
     * Return json formatted data.
     * 
     * @return  string
     */
    final public function toJson()
    {
        return json_encode($this->data);
    }

    /**
     * Return an exact copy of this object.
     * 
     * @return  \Graphite\Component\Objectify\Objectify
     */
    final public function clone()
    {
        return new self($this->toArray(), $this->isMuted());
    }

    /**
     * Merge two data object into one data object.
     * 
     * @param   \Graphite\Component\Objectify\Objectify
     * @param   bool $override
     * @return  $this
     */
    final public function merge(Objectify $object, bool $override = false)
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
    final public function equals(Objectify $object)
    {
        $a = $this->keys();
        $b = $object->keys();

        return array_diff($a, $b) == array_diff($b, $a);
    }

    /**
     * Objectify class factory.
     * 
     * @param   array $data
     * @param   bool $muted
     * @return  $this
     */
    final public static function make(array $data, bool $muted = false)
    {
        return new self($data, $muted);
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