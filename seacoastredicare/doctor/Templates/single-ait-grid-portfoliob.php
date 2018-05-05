{extends $layout}
{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}

{block content}

<div id="container" class="subpage subpage-line clear {isNotActiveWidgetArea post-sidebar}onecolumn{/isNotActiveWidgetArea}">
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix left">
				<div class="post-container">
				{editPostLink $post->id}
						{if !isset($post->options('featured-image')->hideFeatured)}
							<a n:if="$post->thumbnailSrc" href="{$post->thumbnailSrc}">
								<span class="entry-thumbnail">
									{var $imgWidth = 1000}
									{isActiveWidgetArea post-sidebar} {var $imgWidth = 706} {/isActiveWidgetArea}
									{if $gridGalleryOptions['itemType'] == 'image' || $gridGalleryOptions['itemType'] == 'website'}
            							<img src="{thumbnailResize $post->thumbnailSrc, w => $imgWidth, h => 350}" alt="{$post->title}">
            						{elseif $gridGalleryOptions['itemType'] == 'video'}
	              						{if $gridGalleryOptions['videoProvider'] == 'youtube'}
	                						<iframe id="ytplayer" type="text/html" width="{$imgWidth}" height="400" src="http://www.youtube.com/embed/{$gridGalleryOptions['videoID']}?autoplay={$gridGalleryOptions['videoAutoplay']}" frameborder="0"/>
	              						{else}
                							<iframe src="http://player.vimeo.com/video/{$gridGalleryOptions['videoID']}?autoplay={$gridGalleryOptions['videoAutoplay']}" width="{$imgWidth}" height="400" frameborder="0"></iframe>
	              						{/if}
            						{/if}
								</span>
							</a>
						{/if}

						<div class="entry-meta post-footer clearfix clear">
						<div class="date clearfix">
							<a href="{dayLink $post->date}" title="{$post->date|date:$site->dateFormat}" rel="bookmark">
								<div class="day left">{$post->date|date:"d"}</div><div class="month-year left">{$post->date|date:"M"}</div>
							</a>
						</div>
							<p>
							{if $post->type == post}
								<span class="single-posted">
									<strong>{_x 'Posted:', 'posted'}</strong>
									<a href="{$post->author->postsUrl}" title="{__ 'View all posts by'} {$post->author->name}" rel="author">
										{$post->author->name}
									</a>
								</span>
								<span n:if="$post->categories" class="single-categories"><strong>{__ 'Categories:'}</strong> {!$post->categories}</span>
							{/if}
							</p>

							{if $post->type == 'post' and $post->tags}
							<p class="tag-links">
								<span>{__ 'Tagged:'}</span>
								{!$post->tags}
							</p>
							{/if}
							<div class="comments"><span>{$post->commentsCount}</span></div>
						</div>


				</div>
			<div class="entry-content">
				<h1>{$post->title}</h1>
				{!$post->content}
			</div>

			{include snippets/post-nav.php location=> nav-bottom}

			{include comments.php}
		</div>

			{isActiveWidgetArea post-sidebar}
			<div class="sidebar clearfix right">
				{widgetArea post-sidebar}
			</div>
			{/isActiveWidgetArea}
	</div>
</div>

{/block}

{? isset($post->options('testimonials')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xb'}
{define $sectionA}
	{include snippets/testimonials.php, options => $post->options('testimonials')}
{/define}

{? isset($post->options('service-boxes')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xa'}
{define $sectionB}
	{include snippets/service-boxes.php, options => $post->options('service-boxes')}
{/define}