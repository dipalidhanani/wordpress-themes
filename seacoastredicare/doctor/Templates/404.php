{extends $layout}

{block content}

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clearfix clear {isNotActiveWidgetArea subpages-sidebar}onecolumn{/isNotActiveWidgetArea}">
	<!-- MAINBAR -->
		<div class="wrapper">
			<div id="content" class="mainbar entry-content onecolumn">
					<h1>{__ 'Not found'}</h1>
					<h1>{__ "This is somewhat embarrassing, isn't it?"}</h1>

					<p>{__ "It seems we can't find what you are looking for. Perhaps searching, or one of the links below, can help."}</p>

					<form action="{$homeUrl}" id="search" method="get">
					<div>

						<input type="submit" name="submit"  value="Search">
						<input type="text" name="s" placeholder="search...">

					</div>
					</form>
			</div>
			{isActiveWidgetArea subpages-sidebar}
			<div class="sidebar right clearfix">
				{widgetArea subpages-sidebar}
			</div>
			{/isActiveWidgetArea}
		</div>
</div><!-- end of container -->
{/block}