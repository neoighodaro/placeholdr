<?php  namespace Placeholdr; defined('PLACEHOLDR') or die('Restricted access.');

abstract class Driver
{
	/**
	 * Make a new placeholdr image.
	 *
	 * @param  integer  $width
	 * @param  integer $height
	 * @param  string  $text
	 * @return string|false
	 */
	abstract public function make($width, $height, $text);

	/**
	 * Get a created placeholdr image content.
	 *
	 * @param  integer  $width
	 * @param  integer $height
	 * @param  string  $text
	 * @return string
	 */
	abstract public function get($width, $height, $text);
}