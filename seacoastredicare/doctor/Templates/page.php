{extends $layout}
{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}

{block content}

<div id="container" class="subpage subpage-line clear clearfix {isNotActiveWidgetArea subpages-sidebar}onecolumn{/isNotActiveWidgetArea}" {if isset($post) && isset($post->options('content')->overrideGlobal)}style="background-color: {!$post->options('content')->localContentColor}"{/if}>
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">
			<div class="{isActiveWidgetArea subpages}left leftContent{else}content{/isActiveWidgetArea}">
				<h1 class="title1">{$post->title}</h1>
				<div class="toolbar">
					<div id="breadcrumb">{__ 'You are here:'} {breadcrumbs}</div>
				</div>
				{!$post->content}
			</div>
			{include comments.php}
		</div>

		{isActiveWidgetArea subpages-sidebar}
		<div class="sidebar right clearfix">

			{if isset($post)}
				{if isset($post->options('slider')->overrideGlobal) && $post->options('slider')->overrideGlobal}
					{if $post->options('slider')->sliderEnable == false}
						{include snippets/office-information.php, options => $themeOptions->officeInformation}
					{/if}
				{else}
					{if $themeOptions->sections->sliderEnable == false}
						{include snippets/office-information.php, options => $themeOptions->officeInformation}
					{/if}
				{/if}
			{/if}

			{if $post->thumbnailSrc != false }
			<div class="entry-thumbnail sidebar-image">
				<a href="{$post->thumbnailSrc}" title="">
					{!$post->thumbnail}
				</a>
			</div>
			{/if}
			{widgetArea subpages-sidebar}
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