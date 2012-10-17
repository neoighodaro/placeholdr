<?php defined('PLACEHOLDR') or die('Restricted access.');

/**
 * Handle the placeholdr homepage.
 *
 * This page contains the splash page to PlaceHoldr.
 */
Route::get('(:bundle)', function()
{
	return View::make('placeholdr::page')->nest('content', 'placeholdr::index');
});

/**
 * Handle routes to image placeholdrs.
 *
 * @param  string $dimension
 * @param string $text
 * @return mixed
 */
Route::get('(:bundle)/(:any)/(:any?)', array('as' => 'placeholdr', function($dimension, $text = null)
{
	// Straighten up dimensions, we want it to be case-insensitive
	$dimension = strtolower($dimension);

	// A valid dimension needs to have the "x" string, but in cases where a perfect square
	//  placeholdr is needed, the height does not need to be specified thus we will add
	//  the "x" string and height automatically.
	if ( ! str_contains('x', $dimension))
	{
		$dimension = $dimension.'x'.$dimension;
	}

	// Get height and width from dimensions
	list($width, $height) = explode('x', $dimension, 2);

	// Get the placeholdr image content
	$content = Placeholdr::get($width, $height, $text);

	// Status code
	$status = 200;

	// Headers that will be passed with Response
	$headers = array(
		'Content-Type' => 'image/png',
	);

	return Response::make($content, $status, $headers);
}));