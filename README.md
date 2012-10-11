**What is Placeholdr?**

PlaceHoldr is a simple to use [http://laravel.com](Laravel) bundle that helps web designers create place holder images on the fly. There are certain times you need to use an image on a web site but you want to not be bothered with any graphic design at the moment, but you do need an image to hang on that empty space, well, that's where PlaceHoldr comes in handy.

PlaceHoldr simply creates an image of any width and height combination on the fly. You can then use this generated image for whatever placeholding purposes you need it for.

**Placeholdr Installation**

***Manual Installation***

You can download the .zip file from here on github, and drop the Placeholdr directory in your bundles directory.

***Using The Artisan CLI***

You can install the bundle using the Laravel Artisan CLI by running:

<code>
	$ php artisan bundle install placeholdr
</code>

***Activating PlaceHoldr***

After installing placeholdr either manually or via artisan, you can then activate it by adding the following code to your applications bundle.php bundles list:

<code>
	return array
	(
		'placeholdr' => array(
			'handles' => 'placeholdr',
		),
	);
</code>

**Placeholdr Usage**

After installation, using Placeholdr couldnt be easier. All you have to do is follow the instructions below:

***Verifying Installation***

To verify that you have successfully installed and activated PlaceHoldr into your Laravel installation, point your web browser to http://yourlaravel.url/placeholdr/, you should see a nice splash screen that tells and shows you how to use PlaceHoldr.

***Within Laravel, Installed As A Bundle***

If you are using PlaceHoldr as a bundle then you can easily add placeholdr images in your laravel views by using the following code:

<code>
	// In your blade templates
	{{ HTML::placeholdr('300x300', 'Optional Text') }}

	// In your non-blade templates
	<?php echo HTML::placeholdr('300x300', 'Optional Text') ?>
</code>

***Outside Laravel Installation***

Creating PlaceHoldrs externally is also pretty straight forward. All you have to do is use a normal HTML img tag and link directly to the PlaceHoldr URL, specifying the width, height and image text (latter both optional).

<code>
	<img src="http://url.to/placeholdr/300x300/Optional+Text" alt="" />
</code>