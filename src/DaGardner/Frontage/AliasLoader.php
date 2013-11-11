<?php namespace DaGardner\Frontage;
/*
 *  (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Frontage package
 * License: View distributed LICENSE file
 */

/**
 * An simple Alias Loader with lazy loading
 * @author Christian Gärtner <christiangaertner.film@googlemail.com>
 * @version 0.1
 */
class AliasLoader
{
    /**
     * The registered class aliases
     * @var array
     */
    protected $aliases;

    /**
     * Whether this class is registered as autoloader
     * @var boolean
     */
    protected $autoloader = false;

    /**
     * Factory.
     * @param  array  $aliases The aliases.
     * @return self            A new instance
     */
    public static function make(array $aliases = array())
    {
        return new static($aliases);
    }

    /**
     * Constructor.
     * @param array $aliases The aliases.
     */
    public function __construct(array $aliases = array())
    {
        $this->aliases = $aliases;
    }

    public function create($alias)
    {
        if (isset($this->aliases[$alias])) {
            
            return class_alias($this->aliases[$alias], $alias);

        }
    }

    public function alias($alias, $class)
    {
        $this->aliases[$alias] = $class;
    }

    public function makeAutoloader()
    {
        if (!$this->autoloader) {
            
            spl_autoload_register(array($this, 'create'), true, true);
            $this->autoloader = true;

        }
    }

    /**
     * Gets the registered class aliases array.
     *
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }
    
    /**
     * Sets the registered class aliases array.
     *
     * @param array $aliases the aliases
     *
     * @return self
     */
    public function setAliases(array $aliases)
    {
        $this->aliases = $aliases;

        return $this;
    }

    /**
     * Gets whether this class is registered as autoloader.
     *
     * @return boolean
     */
    public function isAutoloader()
    {
        return $this->autoloader;
    }
}