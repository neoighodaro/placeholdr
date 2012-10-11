<?php defined('PLACEHOLDR') or die('Restricted access.');

return array
(
	/**
	 * The active Placeholdr driver.
	 */
	'driver' => 'GD',

	/**
	 * The maximum width (in pixels) allowed for placehold images. When
	 * the width requested exceeds this value, this value will be used as
	 * a fallback value.
	 */
	'maximum_width' => 2000,

	/**
	 * The maximum height (in pixels) allowed for placehold images.  When
	 * the height requested exceeds this value, this value will be used as
	 * a fallback value.
	 */
	'maximum_height' => 1000,

	/**
	 * The path to where all the Placeholdr images are stored. This will still
	 * matter even if the the 'save_created_placeholdrs' setting for some
	 * drivers are set to false, so please make this directory very writable :)
	 */
	'placeholdrs_path' => PLACEHOLDR.'placeholdrs'.DIRECTORY_SEPARATOR,

	/**
	 * Configuration for the GD driver of the Placeholdr bundle.
	 */
	'gd'	=> array
	(
		/**
		 * The path to the font face file that is going to be used for the
		 * placeholdr image text.
		 */
		'font_face' => PLACEHOLDR.'fonts/Crysta.ttf',

		/**
		 * Save each placeholdr file created?
		 *
		 * This can help save a lot of resources as the placehold image will be
		 * created once and reused. Will not have much of a performance impact
		 * if the bundle is being used for production only though.
		 */
		'save_created_placeholdrs' => true,
	),

	'flickr' => array
	(
		'api_key' => '23f847df130df11da00349276579f9be',
		'format' => 'json',
	),
);