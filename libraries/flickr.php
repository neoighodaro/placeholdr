<?php

class Flickr
{
	/**
	 * Flickr developer API key
	 * @var string
	 */
	public $api_key;

	/**
	 * Flickr API return result format.
	 * @var string
	 */
	public $format;

	/**
	 * Sets up the Flickr API keyy and API return format.
	 *
	 * @param string $api_key
	 * @param string $format
	 */
	public function __construct($api_key = '', $format = '')
	{
		if (empty($api_key))
		{
			$this->api_key = Config::get('placeholdr::placeholdr.flickr.api_key');
		}

		// Force json because as at current version the only supported format is JSON.
		// Future releases might include support for other formats.
		$this->format = 'json';
	}

	/**
	 * Search for images using the Flickr API.
	 *
	 * @param  string  $tags
	 * @param  integer  $width
	 * @param  integer  $height
	 * @param  integer $offset
	 * @return object|false
	 */
	public function search($tags, $width, $height, $offset = 1)
	{
		// Pagination!
		$page = floor($offset / 20) + 1;

		// Flickr tag mode
		$tag_mode = 'all';

		// urlencode the Flickr tags
		$tags = urlencode($tags);

		// Flickr sort by..
		$sort = 'interestingness-desc';

		// Media type
		$media = 'photo';

		// License codes
		$license = '4,2,1,5,7';

		// API URL
		$url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&per_page=20&page={$page}"
			."&api_key={$this->api_key}&tags={$tags}&sort={$sort}&media={$media}&license={$license}".
			."&format={$this->format}&tag_mode={$tag_mode}&extras=owner_nam,o_dims,url_o";

		// Fetch from API
		$results = file_get_contents($url);

		// Get the images from result
		$images = $this->_decode($results);

		// Get images specifically
		$images = $images->photos->photo;

		// Array shuffle for randomization
		shuffle($images);

		foreach ($images as $image)
		{
			if ((isset($image->o_width) and $image->o_height) and ($image->o_width >= $width and $image->o_height >= $height))
			{
				// Save image width
				$image->width = $image->o_width;

				// Save image height
				$image->height = $image->o_height;

				// Save image source URL
				$image->source = $image->url_o;

				// Image owner name
				$image->owner = isset($image->ownername) ? $image->ownername : $this->_fetch_owner($image->owner);

				return $image;
			}
		}

		return false;
	}


	/**
	 * Decodes the returned value from the Flickr API.
	 *
	 * @param  mixed $results
	 * @return mixed|object
	 */
	protected function _decode($results)
	{
		switch ($this->format)
		{
			case 'json':
				return json_decode($this->_tidy($results));
				break;
			default:
				return $results;
				break;
		}
	}

	/**
	 * Fetches an image owner name using the owners user ID.
	 *
	 * @param  integer $owner
	 * @return string
	 */
	protected function _fetch_owner($owner)
	{
		// API URI
		$url = "http://api.flickr.com/services/rest/?method=flickr.people.getInfo&api_key={$this->api_key}&user_id={$owner}&format={$this->format}";

		// Result from  API
		$results = file_get_contents($url);

		// User details
		$user = $this->_decode($results);

		if (isset($real_name = $user->person->realname->_content))
		{
			return $real_name;
		}

		return $user->person->username->_content;
	}

	/**
	 * Cleans up the Flickr JSON return results.
	 *
	 * @param  string $flickr_json
	 * @return string
	 */
	protected function _tidy($flickr_json)
	{
		return str_ireplace('jsonFlickrApi(', '', rtrim($flickr_json, ')'));
	}
}