<?php  namespace Placeholdr; defined('PLACEHOLDR') or die('Restricted access.');

use Laravel\File;
use Laravel\Config;

class GD extends Driver
{
	/**
	 * Make a new placeholdr image using the PHP GD extension.
	 *
	 * @param  integer  $width
	 * @param  integer $height
	 * @param  string  $text
	 * @return string|false
	 */
	public function make($width, $height = 0, $text = '')
	{
		// Placeholdr width
		$width = (int) $width;

		// Placeholdr Height
		$height = (int) $height;

		// Placeholdr text
		$text = trim($text);

		// The width is invalid, but lets fallback to width and height of 1px
		if ($width === 0) $width = $height = 1;

		// If the height is not specified or is too small, then default to the same
		// width size, thus making it a square.
		if ($height === 0) $height = $width;

		if ($width > Config::get('placeholdr::placeholdr.maximum_width'))
		{
			$width = Config::get('placeholdr::placeholdr.maximum_width');
		}

		if ($height > Config::get('placeholdr::placeholdr.maximum_height'))
		{
			$height = Config::get('placeholdr::placeholdr.maximum_height');
		}

		if ($text === '' or empty($text))
		{
			$text = "{$width} X {$height}";
		}

		// Image otuput file name
		$image_output_name = md5($width.$height.$text).'.png';

		// Output image file path
		$image_output_file = Config::get('placeholdr::placeholdr.placeholdrs_path').$image_output_name;

		if (File::exists($image_output_file))
		{
			return $image_output_file;
		}
		else
		{
			// Background color
			$bg_color = 'CCCCCC';

			// Text color
			$text_color = 'FFFFFF';

			// create the image resource
			$image = imagecreate($width, $height);

			// we are making two colors one for BackGround and one for ForeGround
			$bg_color = imagecolorallocate(
				$image,
				base_convert(substr($bg_color, 0, 2), 16, 10),
				base_convert(substr($bg_color, 2, 2), 16, 10),
				base_convert(substr($bg_color, 4, 2), 16, 10)
			);

			// Text color
			$text_color = imagecolorallocate(
				$image,
				base_convert(substr($text_color, 0, 2), 16, 10),
				base_convert(substr($text_color, 2, 2), 16, 10),
				base_convert(substr($text_color, 4, 2), 16, 10)
			);

			//Fill the background color
			imagefill($image, 0, 0, $bg_color);

			// Font face
			$font_face = Config::get('placeholdr::placeholdr.gd.font_face');

			// Calculate font size
			$font_size = ($width > $height) ? ($height/10) : ($width/10);

			// write the text .. with some alignment estimations
			imagettftext($image, $font_size, 0, ($width/2) - ($font_size * 2.75), ($height/2) + ($font_size* 0.2), $text_color, $font_face, $text);

			// Output buffer
			ob_start();

			// output the newly created image in png format
			imagepng($image);

			// Copy buffer
			$image_output = ob_get_clean();

			// free up resources
			imagedestroy($image);

			// Save buffer
			return File::put($image_output_file, $image_output) ? $image_output_file : false;
		}
	}

	/**
	 * Get a created placeholdr image content.
	 *
	 * @param  integer  $width
	 * @param  integer $height
	 * @param  string  $text
	 * @return string
	 */
	public function get($width, $height = 0, $text = '')
	{
		if ( ! $image_file = $this->make($width, $height, $text))
		{
			throw new Exception('Failed to create placeholdr.');
		}

		// Get image file contents
		$image_file_contents = File::get($image_file);

		if (Config::get('placeholdr::placeholdr.gd.save_created_placeholdrs') !== true)
		{
			File::delete($image_file);
		}

		return $image_file_contents;
	}
}