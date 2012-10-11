<?php
/**
 * Placeholdr bundle for Laravel.
 *
 * Placeholdr is a Laravel bundle that allows creation of placeholder images
 * that are very useful during design of web sites and web application UI.
 *
 * @package PlaceHoldr
 * @author Neo Ighodaro <neo@creativitykills.net>
 * @copyright 2012 CreativityKills, LLC
 * @link http://github.com/CreativityKills/placeholdr/
 * @version 1.0
 */

/**
 * Placeholdr bundle root path.
 *
 * Using this value instead of Bundle::path('placeholdr') gives the developer
 * more options, especially when trying to rename the bundle.
 */
define('PLACEHOLDR', __DIR__.DIRECTORY_SEPARATOR);

/**
 * Add libraries folder to autoloader loading directories.
 *
 * This will tell Laravel where to look when attempting to autoload Placeholdr
 * classes.
 */
Autoloader::directories(array(
	PLACEHOLDR.'libraries',
));

/**
 * Register a HTML macro for use in views.
 *
 * The Placeholdr HTML macro makes using Placeholdr within the application
 * views a breeze. Simple and elegant, the Laravel way ;)
 *
 * <code>
 * 	{{ HTML::placeholdr('300x300') }}
 * </code>
 */
HTML::macro('placeholdr', function($dimension, $text = '', $attributes = array())
{
	return '<img src="'.URL::to_route('placeholdr', array($dimension, $text)).'"'.HTML::attributes($attributes).' />';
});