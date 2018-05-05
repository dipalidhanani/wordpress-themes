{extends $layout}
{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}
{block content}
<div id="container" class="home abc subpage clear {isActiveWidgetArea homepage}twocolumn{else}onecolumn{/isActiveWidgetArea}" {if isset($post) && isset($post->options('content')->overrideGlobal)}style="background-color: {!$post->options('content')->localContentColor}"{/if}>
{if trim($post->content) != ""}
	<div id="content" class="mainbar entry-content clearfix ">
		{!$post->content}
	</div>

	{isActiveWidgetArea homepage-sidebar}
		<div class="sidebar right clearfix">
		  {widgetArea homepage-sidebar}
		</div>
	{/isActiveWidgetArea}
{/if}
</div>
{/block}

{? isset($post->options('testimonials')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xa'}
{define $sectionA}
	{include snippets/testimonials.php, options => $post->options('testimonials')}
{/define}

{? isset($post->options('service-boxes')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb'}
{define $sectionB}
	{include snippets/service-boxes.php, options => $post->options('service-boxes')}
{/define}