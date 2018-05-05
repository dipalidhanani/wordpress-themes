{extends $layout}

{block content}

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clearfix {isNotActiveWidgetArea subpages-sidebar}onecolumn{/isNotActiveWidgetArea}">
	<!-- MAINBAR -->
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">

				{if $posts}

					<header class="page-header">
						<h1 class="page-title">
							{__ 'Search Results for:'} <span>{$site->searchQuery}</span>
						</h1>
					</header>
					<style type="text/css" scoped="scoped">
						div.non-thumb-item { display: none; }
						div.entry-thumb-img { display: none; }
						div.tool-buttons { display: none; }
					</style>


					{include snippets/content-nav.php location => 'nav-above'}

					{include snippets/content-loop.php posts => $posts}

					{include snippets/content-nav.php location => 'nav-below'}

				{else}

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title">{__ 'Nothing Found'}</h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p>{__ 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.'}</p>
							{include snippets/search-form.php}
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				{/if}

		</div>
		<!-- SIDEBAR -->
		{isActiveWidgetArea subpages-sidebar}
			<div class="sidebar right clearfix">
				{widgetArea subpages-sidebar}
			</div>
		{/isActiveWidgetArea}
		<!-- end of sidebar -->

	</div><!-- end of wrapper -->

</div><!-- end of container -->
{/block}