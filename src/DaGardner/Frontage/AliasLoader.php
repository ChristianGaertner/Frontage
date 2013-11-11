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
     * 
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

    /**
     * Creates an class alias
     * Note first you need to add the alias to the class (alias())
     * 
     * @param  string $alias The alias name
     * 
     * @return boolean       Whether the aliasing was successful
     */
    public function create($alias)
    {
        if (isset($this->aliases[$alias])) {
            
            return class_alias($this->aliases[$alias], $alias);

        }
    }

    /**
     * Adds a alias to the list.
     * This won't create the alias.
     * Use create() for this.
     * 
     * @param  string $alias The alias name
     * @param  string $class The actual class name
     * 
     * @return self
     */
    public function alias($alias, $class)
    {
        $this->aliases[$alias] = $class;

        return $this;
    }

    /**
     * Registeres the aliasloader as autoloader
     * This way we can lazy load these aliases
     * 
     * @return self
     */
    public function makeAutoloader()
    {
        if (!$this->autoloader) {
            
            spl_autoload_register(array($this, 'create'), true, true);
            $this->autoloader = true;

        }

        return $this;
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