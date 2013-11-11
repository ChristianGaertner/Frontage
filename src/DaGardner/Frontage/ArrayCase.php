<?php namespace DaGardner\Frontage;
/*
 *  (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Frontage package
 * License: View distributed LICENSE file
 */

use Closure;
use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

/**
 * A OOP approach of handling arrays
 * @author Christian Gärtner <christiangaertner.film@googlemail.com>
 * @version 0.2
 */
class ArrayCase implements Countable, IteratorAggregate, ArrayAccess
{
    /**
     * The wrapped array
     * @var array
     */
    protected $array;

    /**
     * Factory.
     * 
     * @param array $array The array to initialize this ArrayCase
     * 
     * @return new self
     */
    public static function make(array $array = array())
    {
        return new static($array);
    }

    /**
     * Constructor.
     * 
     * @param array $array The array to initialize this ArrayCase
     */
    public function __construct(array $array = array())
    {
        $this->setArray($array);
    }

    /**
     * Returns the array
     *
     * @uses toArray()
     * 
     * @return array
     */
    public function all()
    {
        return $this->getArray();
    }

    /**
     * Returns the value for the given key
     * 
     * @param  string $key     The key of the item
     * @param  mixed  $default The value gets returned if the key doesn't exist
     * 
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->array) ? $this->array[$key] : $default;
    }

    /**
     * Returns the first element
     * 
     * @return mixed
     */
    public function first()
    {
        return count($this->array) > 0 ? reset($this->array) : null;
    }

    /**
     * Returns the last element
     * 
     * @return mixed
     */
    public function last()
    {
        return count($this->array) > 0 ? end($this->array) : null;
    }

    /**
     * Returns and removes the first element
     * 
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->array);
    }

    /**
     * Returns and removes the last element
     * 
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->array);
    }

    /**
     * Prepend to the array
     * 
     * @param  mixed $value
     * 
     * @return self
     */
    public function prepend($value)
    {
        array_unshift($this->array, $value);

        return $this;
    }

    /**
     * Adds to the array
     * 
     * @param  string  $key      The key
     * @param  mixed   $value    The value
     * @param  boolean $override Whether existing values should get overwritten
     * 
     * @return boolean            Whether it has been stored
     */
    public function put($key, $value, $override = false)
    {
        if ($this->has($key) && !$override) {
                return false;
        }

        $this->array[$key] = $value;
        return true;
    }

    /**
     * Whether the array has an item
     * 
     * @param  string  $key The key of the item
     * 
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $this->array);
    }

    /**
     * Removes an item from the array
     * 
     * @param  string $key The key of the item
     * 
     * @return self
     */
    public function remove($key)
    {
        unset($this->array[$key]);

        return $this;
    }

    /**
     * Merges the internal array with the input
     * 
     * @param  array|ArrayCase  $array
     * 
     * @return self
     */
    public function merge($array = array())
    {
        if ($array instanceof ArrayCase) {
            
            $array = $array->getArray();

        }

        $this->array = array_merge($this->array, $array);

        return $this;
    }

    /**
     * Returns the array keys
     * 
     * @return string The keys
     */
    public function keys()
    {
        return array_keys($this->array);
    }

    /**
     * Appends an item to the end
     * 
     * @param  mixed $value  The value
     * 
     * @return self
     */
    public function push($value)
    {
        $this->array[] = $value;
        return $this;
    }

    /**
     * Executes the callback over each item
     * 
     * @param  Closure $callback The callback
     * 
     * @return self
     */
    public function each(Closure $callback)
    {
        array_map($callback, $this->array);

        return $this;
    }

    /**
     * Json encodes the array
     * @param  integer $flags The flags to pass to json_encode
     * @return string         The json string
     */
    public function json($flags = 0)
    {
        return json_encode($this->array, $flags);
    }

    /**
     * Gets the wrapped array.
     *
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }
    
    /**
     * Sets the wrapped array.
     *
     * @param array $array the array
     *
     * @return self
     */
    public function setArray(array $array)
    {
        $this->array = $array;

        return $this;
    }

    /**
     * Returns the Iterator
     * 
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->array);
    }

    /**
     * Counts the array
     * 
     * @return integer The count
     */
    public function count()
    {
        return count($this->array);
    }

    /**
     * Returns the JSON encoded string
     * 
     * @return string The array as json
     */
    public function __toString()
    {
        return $this->json();
    }

    /**
     * ArrayAccess
     *
     * @uses has()
     * 
     * @param  mixed $offset  The key
     * 
     * @return mixed
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * ArrayAccess
     *
     * @uses remove()
     * 
     * @param  mixed $offset  The key
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * ArrayAccess
     *
     * @uses get()
     * 
     * @param  mixed $offset  The key
     * 
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * ArrayAccess
     *
     * NOTE: This will override without needing to specify (as in put())
     * @uses put()
     * 
     * @param  mixed $offset  The key
     * @param  mixed $value   The value to store
     */
    public function offsetSet($offset, $value)
    {
        $this->put($offset, $value, true);
    }
}