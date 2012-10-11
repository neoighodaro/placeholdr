<h1>What is Placeholdr?</h1>
<p>
	PlaceHoldr is a simple to use Laravel bundle that helps web designers create place holder images on the fly.
	There are certain times you need to use an image on a web site but you want to not be bothered with any graphic
	design at the moment, but you do need an image to hang on that empty space, well thats where PlaceHoldr comes
	in handy.
</p>
<p>
	PlaceHoldr simply creates an image of any width and height combination on the fly. You can then use it for whatever
	placeholding you need.
</p>

<h1>Placeholdr Usage</h1>
<p>
	Using Placeholdr couldnt be easier. All you have to do is follow the instructions below:
</p>

<h3>In Laravel, Installed As A Bundle</h3>
<p>
	If you are using PlaceHoldr as a bundle then you can easily add placeholdr images in your <code>views</code> by
	simply using:
	<p>
		<code>
			// In your blade templates<br />
			{{ str_repeat('{', 2) }} HTML::placeholdr('300x300', 'Optional Text') {{ str_repeat('}', 2) }}<br />
			<br />
			// In your non-blade templates<br />
			{{ e("<?php echo HTML::placeholdr('300x300', 'Optional Text') ?>") }}<br />
		</code>
	</p>
</p>

<h3>Creating PlaceHoldrs Externally</h3>
<p>
	Creating PlaceHoldrs externally is also straight forward. All you have to do is use a normal HTML img tag
	and link directly to the PlaceHoldr URL, specifying the width and height (optional).
	<p>
		<code>
			&lt;img src=&quot;{{ URL::to_route('placeholdr', array('300x300', urlencode('Optional Text'))) }}&quot; alt="" /&gt;
		</code>
	</p>
</p>