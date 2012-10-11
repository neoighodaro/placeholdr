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
	// Starighten up dimensions
	$dimension = strtolower($dimension);

	// A valid dimension needs to have the "x" string, but in cases where
	// a perfect square placeholdr is needed, the height does not need to be specified
	// thus we will add his ourselves.
	if ( ! str_contains('x', $dimension))
	{
		$dimension = $dimension.'x'.$dimension;
	}

	// Get height and width from dimensions
	list($width, $height) = explode('x', $dimension, 2);

	// Custom headers
	$custom_headers = array(
		'Content-Type' => 'image/png',
	);

	// Content
	$content = Placeholdr::get($width, $height, $text);

	return Response::make($content, 200, $custom_headers);
}));