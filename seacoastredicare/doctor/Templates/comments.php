{if $post->comments}
<div id="comments">
{/if}
{if !$post->isPasswordRequired}

{if $post->comments}

		<h2 id="comments-title">
			{_n 'Comment', 'Comments', $post->commentsCount} ({$post->commentsCount})
		</h2>

		{include snippets/comments-pagination.php, location => 'above'}

	{listComments comments => $post->comments}
			{if $comment->type == 'pingback' or $comment->type == 'trackback'}
			<li class="post pingback">
				<p>
			Pingback
				{!$comment->author->link}
				{editCommentLink $comment->id}
				</p>
			{else}

			{* this is start tag, but end tag is missing in this template, it is included in {/listComments} macro. Weird. I know. *}
			<li class="{$comment->classes}">

				<article id="comment-{$comment->id}" class="comment">
					<div class="comment-meta">
						<span class="comment-avatar">
							{!$comment->author->avatar}
						</span>

						<span class="comment-links">
								<span class="reply">
									{capture $replyTitle} {!__ 'Reply <span>&darr;</span>'} {/capture}
									{commentReplyLink $replyTitle, $comment->args, $comment->depth, $comment->id}
								</span><!-- .reply -->
								{editCommentLink $comment->id}
						</span>

						{if !$comment->approved}
							<em class="comment-awaiting-moderation">{__ 'Your comment is awaiting moderation.'}</em><br>
						{/if}
						<span class="theRow clearfix">
								<a href="{$comment->url}" class="comment-date"><!--
								--><time datetime="{$comment->date|date:'c'}"><!--
									-->{$comment->date|date:$site->dateFormat} {_x 'at', 'comment publish time'} {$comment->date|date:$site->timeFormat}<!--
								--></time><!--
							--></a>
								<cite class="fn">{!$comment->author->nameWithLink}</cite>
						</span>
					</div>
					<div class="comment-text">

						<div class="comment-content">

								{!$comment->content}
						</div>
					</div>
				</article><!-- #comment-## -->
			{/if}
		{/listComments}

		{include snippets/comments-pagination.php, location => 'below'}

{elseif !$post->hasOpenComments and $post->type != 'page' and $post->hasSupportFor('comments')}

	<p class="nocomments">{__ 'Comments are closed.'}</p>

{/if}

{commentForm}

{else}
	<p class="nopassword">{__ 'This post is password protected. Enter the password to view any comments.'}</p>
{/if}
{if $post->comments}
</div><!-- #comments -->
{/if}
