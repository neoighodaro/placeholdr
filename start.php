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

/*
|------------------------------------------------------------------------------------------------------------
| Placeholdr bundle root path.
|------------------------------------------------------------------------------------------------------------
|
| Using this value instead of Bundle::path('placeholdr') gives the developer
| more options, especially when trying to rename the bundle.
|
 */

define('PLACEHOLDR', __DIR__.DIRECTORY_SEPARATOR);


/*
|------------------------------------------------------------------------------------------------------------
| Add libraries folder to autoloader loading directories.
|------------------------------------------------------------------------------------------------------------
|
| This will tell Laravel where to look when attempting to autoload Placeholdr
| classes.
|
 */

Autoloader::directories(array(
	PLACEHOLDR.'libraries',
));

/**
 * Placeholdr helper to create placeholdrs on the fly.
 *
 * This helper creates a placeholdr image by creating a HTML img tag
 * in the views of your Laravel application.
 *
 * <code>
 * 	{{ placeholdr('300x300', 'Optional Text') }}
 * </code>
 *
 * @param string $dimension
 * @param string $text
 * @param array $attributes
 * @return string
 */
function placeholdr($dimension, $text = '', $attributes = array())
{
	// URL encode optional text
	$text = rawurlencode($text);

	return '<img src="'.URL::to_route('placeholdr', array($dimension, $text)).'"'.HTML::attributes($attributes).' />';
}

/**
 * Register a HTML macro for use in views.
 *
 * The Placeholdr HTML macro makes using Placeholdr within the application
 * views a breeze. Simple and elegant, the Laravel way ;). This is just a clean Laravelish
 * wrapper around the placeholdr helper function.
 *
 * <code>
 * 	{{ HTML::placeholdr('300x300', 'Optional Text') }}
 * </code>
 *
 * @param string $dimension
 * @param string $text
 * @param array $attributes
 * @return string
 */
HTML::macro('placeholdr', function($dimension, $text = '', $attribute = array())
{
	return placeholdr($dimension, $text, $attribute);
});