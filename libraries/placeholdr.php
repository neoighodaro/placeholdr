<?php defined('PLACEHOLDR') or die('Restricted access.');

class Placeholdr
{
	/**
	 * Singleton instance of Placeholdr_Driver class.
	 * @var Placeholdr_Driver
	 */
	public static $instance;

	/**
	 * Returns a singleton instance of Placeholdr_Driver class.
	 *
	 * @return Placeholdr_Driver
	 */
	public static function instance()
	{
		if (static::$instance === null)
		{
			$driver = '\\PlaceHoldr\\'.Config::get('placeholdr::placeholdr.driver');

			static::$instance = new $driver;
		}

		return static::$instance;
	}

	/**
	 * Magically call methods from the Placeholdr_Driver class.
	 *
	 * @param  string $method
	 * @param  array $parameters
	 * @return mixed
	 */
	public static function __callStatic($method, $parameters)
	{
		return call_user_func_array(array(static::instance(), $method), $parameters);
	}
}