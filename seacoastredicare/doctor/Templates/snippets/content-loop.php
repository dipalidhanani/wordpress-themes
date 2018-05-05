<section class="grid-style clear">
{foreach $posts as $post}

	<article id="post-{$post->id}" n:class="$post->htmlClasses, !$post->thumbnailSrc ? no-thumbnail">
			<header class="entry-header">
				<div n:class="$post->thumbnailSrc ? entry-thumbnail : title-no-thumbnail">

					<div n:class="$post->thumbnailSrc ? entry-thumb-img : no-thumb-img-description">
						<a n:if="$post->thumbnailSrc" href="{$post->permalink}"><img src="{thumbnailResize $post->thumbnailSrc, w => 220, h => 170}" alt=""/></a>
					</div>
				</div>
			</header><!-- /.entry-header -->


			{if $site->isSearch}

			<div class="entry-summary">
				<h2 class="entry-title">
					<a href="{$post->permalink}" title="{__ 'Permalink to'} {$post->title}" rel="bookmark">{$post->title}</a>
				</h2>
				{$post->excerpt}
			</div>

			{else}


			<div class="entry-content">
				<div class="tool-buttons">
					{editPostLink $post->id}
				</div>
				<h2 class="entry-title"><a href="{$post->permalink}" title="{__ 'Permalink to'} {$post->title}" rel="bookmark">{$post->title}</a></h2>
				<div class="text-content">
					{!$post->content}
				</div>

				<div class="author">
					<strong>{_x 'Posted:', 'posted on'}</strong>
					<a href="{$post->author->postsUrl}" title="{__ 'View all posts by'} {$post->author->name}" rel="author">{$post->author->name}</a>
				</div>

				<div class="bottom entry-meta clearfix clear">
					<div class="date clearfix">
						<a href="{dayLink $post->date}" title="{$post->date|date:$site->dateFormat}" rel="bookmark">
							<span class="day left">{$post->date|date: d}</span>
							<span class="month-year left">{$post->date|date: M}</span>
						</a>
					</div>

					{if $post->type == post}
					<p n:if="$post->categories"><strong>{__ 'Categories:'}</strong> {!$post->categories}</p>
					<p n:if="$post->tags"><strong>{__ 'Tags:'}</strong> {!$post->tags}</p>
					{/if}

					<div class="comments"><span>{$post->commentsCount}</span></div>
				</div>

			</div><!-- .entry-content -->
			{/if}
	</article><!-- /#post-{$post->id} -->
{/foreach}
</section>