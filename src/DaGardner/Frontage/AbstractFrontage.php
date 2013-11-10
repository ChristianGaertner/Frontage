<?php namespace DaGardner\Frontage;
/*
 *  (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Frontage package
 * License: View distributed LICENSE file
 */

/**
 * Frontage's main class
 * @author Christian Gärtner <christiangaertner.film@googlemail.com>
 * @version 0.1
 */
abstract class AbstractFrontage
{
	/**
	 * The container for this class to look for objects
	 * @var \DaGardner\DaContainer\ResolverInterface
	 */
	protected static $container;

	/**
	 * Inject the container.
	 * @param \DaGardner\DaContainer\ResolverInterface $container The container
	 */
	public static function setContainer(\DaGardner\DaContainer\ResolverInterface $container)
	{
		static::$container = $container;
	}

	public static function getFacadeID()
	{
		throw new \RuntimeException('Method <getFacadeID> not implemented');
	}

	public static function __callStatic($method, $params)
	{
		$instance = static::$container->resolve(static::getFacadeID());

		return call_user_func_array(array($instance, $method), $params);
	}
}