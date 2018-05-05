{extends $layout}

{block content}

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clear clearfix {isNotActiveWidgetArea blog-sidebar}onecolumn{/isNotActiveWidgetArea}">
	<!-- MAINBAR -->
	<div class="wrapper">	
		<div id="content" class="mainbar entry-content clearfix">


				{if $posts}

					<header class="page-header">
						<h1 class="page-title">
							{if $archive->isDay}
								{__ 'Daily Archives:'} <span>{$posts[0]->date|date:$site->dateFormat}</span>
							{elseif $archive->isMonth}
								{__ 'Monthly Archives:'}' <span>{$posts[0]->date|date:'F Y'}</span>
							{elseif $archive->isYear}
								{__ 'Yearly Archives:'}' <span>{$posts[0]->date|date:'Y'}</span>
							{else}
								{__ 'Blog Archives'}
							{/if}
						</h1>
					</header>

					{include snippets/content-nav.php location => 'nav-above'}

					{include snippets/content-loop.php posts => $posts}

					{include snippets/content-nav.php location => 'nav-below'}

				{else}

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h2 class="entry-title">{__ 'Nothing Found'}</h2>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p>{__ 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.'}</p>
							{include snippets/search-form.php}
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				{/if}


		</div>
		<!-- SIDEBAR -->
		{isActiveWidgetArea blog-sidebar}
		<div class="sidebar clearfix right">

			{widgetArea blog-sidebar}

		</div><!-- end of sidebar -->
		{/isActiveWidgetArea}
		
	</div><!-- end of wrapper -->
</div><!-- end of container -->