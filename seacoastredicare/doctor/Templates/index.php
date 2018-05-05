{extends $layout}

{if !$isIndexPage}
	{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}
{/if}

{block content}

<div id="container" class="subpage, subpage-line, clear, clearfix">
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">
			<div id="content-wrapper">
				{if !$isIndexPage}
					<h1>{$post->title}</h1>
					{!$post->content}
				{/if}

				{if $posts}

					{include snippets/content-nav.php location => 'nav-above'}

					{include snippets/content-loop.php posts => $posts}

					{include snippets/content-nav.php location => 'nav-below'}

				{else}

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h2 class="entry-title">{__ 'Nothing Found'}</h2>
						</header>

						<div class="entry-content">
							<p>{__ 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.'}</p>
							{include snippets/search-form.php}
						</div>
					</article>

				{/if}

			</div>
		</div>


		{isActiveWidgetArea blog-sidebar}
		<div class="sidebar right clearfix">
			{widgetArea blog-sidebar}
		</div><!-- end of sidebar -->
		{/isActiveWidgetArea}
	</div>
</div>

{/block}

{if !$isIndexPage}
	{? isset($post->options('testimonials')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xb'}
	{define $sectionA}
		{include snippets/testimonials.php, options => $post->options('testimonials')}
	{/define}

	{? isset($post->options('service-boxes')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xa'}
	{define $sectionB}
		{include snippets/service-boxes.php, options => $post->options('service-boxes')}
	{/define}
{/if}