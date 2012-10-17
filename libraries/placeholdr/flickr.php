<?php

class Flickr extends Driver
{
	public function make($width, $height = 0, $tags = '')
	{
	}

	public function get($width, $height, $tags = '')
	{
	}

	public function get_image($width, $height, $tags = '')
	{
		// The cache path
		$cache_path = Config::get('placeholdr::placeholdr.placeholdrs_path');

		// The cached image
		$cached_image = $cache_path.md5('flickr'.$width.$height.$tags).'.png';

		// Cache time in minutes
		$cache_minutes = 30;

		if (File::exists($cached_image))
		{
			if (File::modified($cached_image) > time() - (60 * $cache_minutes))
			{
				return $cached_image;
			}
			elseif (is_file($cached_image))
			{
				unlink($cached_image);
			}

			// Increment.
			$i = 0;

			// Flickr image
			$flickr_image = false;

			while ( ! $flickr_image)
			{
				$flickr = new Flickr;
				$flickr_image = ($i > 3) ? $flickr->search($width, $height, '') : $flickr->search($width, $height, $tags);
				$i++;
			}

			// Image source
			$image_source = $flickr_image->source;

			// Width & Height
			$image_width = $flickr_image->width;
			$image_height = $flickr_image->height;

			// Get image contents
			$image = File::get($image_source);

			if ( ! File::put($cached_image, $image))
			{
				throw new Exception('Unable to save image from Flickr.');
			}


		}
	}
}