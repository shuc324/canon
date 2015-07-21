<?php

namespace Enabler\Foundation;

class Application
{
	/**
	 * The Enabler framework version.
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * The root path for the Enabler installation.
	 * @var string
	 */
	protected $rootPath;

	/**
	 * Create a new Enabler application instance.
	 */
	public function __construct($rootPath = null)
	{


		$rootPath && $this->setRootPath($rootPath);
	}

	/**
	 * Get the version number of the application
	 * @return string
	 */
	public function version()
	{
		return static::VERSION;
	}

	/**
	 * Set the root path for the application.
	 * @param  string $rootPath
	 */
	public function setRootPath($rootPath)
	{
		$this->rootPath = rtrim($rootPath, '\/');
	}

	/**
	 * Get the event loop instance.
	 */
	public function getLoop()
 	{
 		return React\EventLoop\Factory::create();
 	}

	/**
	 * Run the application.
	 */
	public function run()
	{

	}
}