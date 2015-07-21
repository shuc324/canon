<?php

namespace Canon\Foundation;

/**
 * Example: AliasLoader::getInstance($aliases)->register();
 */

class AliasLoader
{
	/**
	 * The array of class aliases.
	 * @var array
	 */
	protected $aliases;

	/**
	 * Indicates if a loader has been registered
	 * @var bool
	 */
	protected $registered = false;

	/**
	 * The singleton instance of the loader.
	 * @var  \Canon\Foundation\AliasLoader
	 */
	protected static $instance;

	/**
	 * Create a new AliasLoader instance.
	 * @param array $aliases
	 */
	private function __construct(array $aliases)
	{
		$this->aliases = $aliases;
	}

    /**
     * Set the value of the singleton alias loader.
     *
     * @param \Canon\Foundation\AliasLoader $loader
     */
    public static function setInstance($loader)
    {
        static::$instance = $loader;
    }

	/**
	 * Get or create the singleton alias loader instance
	 * @param array $aliases
	 * @return \Canon\Foundation\AliasLoader
	 */
	public static function getInstance(array $aliases = [])
	{
		if (is_null(static::$instance)) {
			return static::$instance = new static($aliases);
		}

		$aliases = array_merge(static::$instance->getAliases(), $aliases);

		static::$instance->setAliases($aliases);

		return static::$instance;
	}

	/**
	 * Set the registered aliases.
	 * @param array $aliases
	 */
	public function setAliases(array $aliases)
	{
		$this->aliases = $aliases;
	}

	/**
	 * Get the registered aliases.
	 * @return array
	 */
	public function getAliases()
	{
		return $this->aliases;
	}

	/**
	 * Register the loader on the auto-loader stack.
	 */
	public function register()
	{
		if (!$this->registered) {
			$this->prependToLoaderStack();
			$this->registered = true;
		}
	}

	/**
	 * Prepend the load method to the auto-loader stack.
	 */
	public function prependToLoaderStack()
	{
		spl_autoload_register([$this, 'load'], true, true);
	}

	/**
	 * Load a class alias if it is registered
	 * @param string $alias
	 */
	public function load($alias)
	{
		if (isset($this->aliases[$alias])) {
			return class_alias($this->aliases[$alias], $alias);
		}
	}

	/**
     * Add an alias to the loader.
     * @param  string  $class
     * @param  string  $alias
     */
    public function alias($class, $alias)
    {
        $this->aliases[$class] = $alias;
    }

	/**
	 * Clone method
	 */
	private function __clone()
	{

	}
}