{if isset($options->testimonialsDisplay) and $options->testimonialsDisplay}
	{var $testimonials = $site->create('testimonial', $options->testimonialsCategory)}
	{if $testimonials}
	<section class="section testimonials-section" style="background-color: {!$options->testimonialsBackground}">
		<div class="testimonials-container wrapper">
			<ul class="testimonials clearfix">
				{foreach $testimonials as $testimonial}
				<li id="testimonial-{$iterator->getCounter()}" class="testimonial {if $iterator->getCounter() == 1}active{/if} clearfix" style="z-index: {count($testimonials) - $iterator->getCounter()};{if $iterator->getCounter() == 1}display: block{/if}">
					<a n:if="!empty($testimonial->options->testimonialsLink)" href="{$testimonial->options->testimonialsLink}" class="logo left"><img src="{thumbnailResize, $testimonial->thumbnailSrc, w => 51, h => 51}" alt="{$testimonial->post_title}" /></a>
					<div class="left-cnt clearfix">
						<div class="testimonial-text">{!$testimonial->content}</div>
						<div class="testimonial-author right"><span>by <strong>{$testimonial->options->testimonialsAuthor}</strong></span></div>
					</div>
				</li>
				{/foreach}
			</ul>
			{if count($testimonials) > 1}
			<div class="testimonial-arrows clearfix">
				<div class="arrow arrow-left left">&lt;</div>
				<div class="arrow arrow-right right">&gt;</div>
			</div>
			{/if}
		</div>
	</section>
	{/if}
{/if}