{extends $layout}

{block content}

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clear {isNotActiveWidgetArea blog-sidebar}onecolumn{/isNotActiveWidgetArea}">
	<!-- MAINBAR -->
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">

				{if $posts}

					<h1 class="page-title author">
						{__ 'Author Archives:'}
						<span class="vcard">
							<a href="{$author->postsUrl}" title="{$author->name}" rel="me">{$author->name}</a>
						</span>
					</h1>


					{include snippets/content-nav.php location => nav-above}

					{if !empty($author->bio)}
					<div id="author-info">
						<div id="author-avatar">
							{$author->avatar(60)}
						</div><!-- #author-avatar -->
						<div id="author-description">
							{__ 'About'} {$author->name}
							{$author->bio}
						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
					{/if}

					{include snippets/content-loop.php posts => $posts}

					{include snippets/content-nav.php location => nav-below}

				{else}

					<article id="post-0" class="post no-results not-found">

						<h1 class="entry-title">{__ 'Nothing Found'}</h1>

						<div class="entry-content">
							<p>{__ 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post'}</p>
							{include snippets/search-form.php}
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				{/if}

		</div><!-- end of mainbar -->

		<!-- SIDEBAR -->
		{isActiveWidgetArea blog-sidebar}
		<div class="sidebar right clearfix">

			{widgetArea blog-sidebar}

		</div><!-- end of sidebar -->
		{/isActiveWidgetArea}
	</div><!-- end of -wrapper -->
</div><!-- end of container -->
{/block}