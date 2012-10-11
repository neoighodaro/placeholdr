<?php

class PlaceholdrTest extends PHPUnit_Framework_TestCase {

	/**
	 * Start and setup the Placeholdr bundle if not already started.
	 *
	 * @return null
	 */
	public function __construct()
	{
		Bundle::start('placeholdr');
	}

	/**
	 * Test the GD driver make and get methods.
	 *
	 * @return null
	 */
	public function testGDGet()
	{
		// GD driver only
		if (Config::get('placeholdr::placeholdr.driver') !== 'GD') return;

		// Height and width
		$width = $height = 300;

		// Text
		$text = $width.' X '.$height;

		// File path
		$path = Config::get('placeholdr::placeholdr.placeholdrs_path');

		// File name
		$file_name = md5($width.$height.$text).'.png';

		try
		{
			// test create placeholdr
			$this->assertTrue(
				Placeholdr::make($width, $height, $text) === $path.$file_name
			);

			// Actual image contents after create
			$image_contents = File::get($path.$file_name);
		}
		catch(Exception $e)
		{
			$image_contents = '';
		}

		// Run test
		$this->assertTrue(
			Placeholdr::get($width, $height, $text) === $image_contents
		);
	}
}