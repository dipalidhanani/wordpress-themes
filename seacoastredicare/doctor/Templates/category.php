{extends $layout}

{block content}

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clearfix clear {isNotActiveWidgetArea blog-sidebar}onecolumn{/isNotActiveWidgetArea}">
	<!-- MAINBAR -->
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">

				{if $posts}

					<header class="page-header">
						<h1 class="page-title">
							{__ 'Category Archives: '}<span>{$category->title}</span>
						</h1>

						{if !empty($category->description)}
							<div class="category-archive-meta">{!$category->description}</div>
						{/if}
					</header>

					{include snippets/content-nav.php location => 'nav-above'}

					{include snippets/content-loop.php posts => $posts}

					{include snippets/content-nav.php location => 'nav-below'}

				{else}

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title">{__ 'Nothing Found'}</h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p>{__ 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post'}</p>
							{include snippets/search-form.php}
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				{/if}


		</div><!-- end of mainbar -->

		<!-- SIDEBAR -->
		{isActiveWidgetArea blog-sidebar}
		<div class="sidebar clearfix right">
			{widgetArea blog-sidebar}
		</div><!-- end of sidebar -->
		{/isActiveWidgetArea}
		
	</div><!-- end of wrapper -->
</div><!-- end of container -->
{/block}