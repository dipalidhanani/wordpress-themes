<nav id="nav-single">

	{capture $prev}{!__ '%s Previous' |printf: '<span class="meta-nav">&larr;</span>'}{/capture}

	{capture $next}{!__ 'Next %s' |printf: '<span class="meta-nav">&rarr;</span>'}{/capture}

	<!--<span class="nav-previous">{? previous_image_link(false, $prev)}</span>
	<span class="nav-next">{? next_image_link(false, $next)}</span>-->
	<div class="nav-previous">{prevPostLink $prev}</div>
	<div class="nav-next">{nextPostLink $next}</div>
</nav><!-- #nav-single -->