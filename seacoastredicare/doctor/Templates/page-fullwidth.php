{extends $layout}
{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null}

{block content}

<div id="container" class="subpage defaultContentWidth clear onecolumn" {if isset($post) && isset($post->options('content')->overrideGlobal)}style="background-color: {!$post->options('content')->localContentColor}"{/if}>
	<div id="content" class="mainbar entry-content clearfix">
		<div id="content-wrapper">
			<h1>{$post->title}</h1>

			{if $post->thumbnailSrc}
			<div class="entry-thumbnail">
				<img src="{thumbnailResize $post->thumbnailSrc, w => 640, h => 200}" alt="" />
			</div>
			{/if}

			{!$post->content}

			{include comments.php}

		</div>
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