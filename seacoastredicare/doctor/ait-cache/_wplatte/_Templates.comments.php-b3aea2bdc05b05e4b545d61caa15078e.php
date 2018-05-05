<?php //netteCache[01]000482a:2:{s:4:"time";s:21:"0.81364000 1377789359";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/comments.php";i:2;i:1377786856;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/comments.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'u64g1wb3ht')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($post->comments): ?>
<div id="comments">
<?php endif ;if (!$post->isPasswordRequired): ?>

<?php if ($post->comments): ?>

		<h2 id="comments-title">
			<?php echo NTemplateHelpers::escapeHtml(_n('Comment', 'Comments', $post->commentsCount, 'ait'), ENT_NOQUOTES) ?>
 (<?php echo NTemplateHelpers::escapeHtml($post->commentsCount, ENT_NOQUOTES) ?>)
		</h2>

<?php NCoreMacros::includeTemplate("snippets/comments-pagination.php", array('location' => 'above') + $template->getParams(), $_l->templates['u64g1wb3ht'])->render() ?>

<?php 
			$a = array('comments' => $post->comments);
			$depth = 1;
			if(isset($a["begin"]))
				echo $a["begin"];
			else
				echo "<ol class=\"commentlist\">";

			if(isset($a["childrenClass"]))
				$children = " class=\"$a[childrenClass]\"";
			else
				$children = " class=\"children\"";

			$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($a["comments"]) as $comment):
				if ($comment->depth > $depth){
					echo "<ul{$children}>";
					$depth = $comment->depth;
				}elseif($comment->depth == $depth and !$iterator->isFirst()){
					echo "</li>";
				}elseif($comment->depth < $depth){
					echo "</li>";
					echo str_repeat("</ul></li>", $depth - $comment->depth);
					$depth = $comment->depth;
				}
			 if ($comment->type == 'pingback' or $comment->type == 'trackback'): ?>
			<li class="post pingback">
				<p>
			Pingback
				<?php echo $comment->author->link ?>

<?php WpLatteFunctions::editCommentLink(__("Edit", "ait"), $comment->id, "<span class=\"edit-link\">", "</span>") ?>
				</p>
<?php else: ?>

						<li class="<?php echo htmlSpecialChars($comment->classes) ?>">

				<article id="comment-<?php echo htmlSpecialChars($comment->id) ?>" class="comment">
					<div class="comment-meta">
						<span class="comment-avatar">
							<?php echo $comment->author->avatar ?>

						</span>

						<span class="comment-links">
								<span class="reply">
									<?php ob_start() ?> <?php echo __('Reply <span>&darr;</span>', 'ait') ?>
 <?php $replyTitle = ob_get_clean() ?>

<?php 
				$a = array($replyTitle, $comment->args, $comment->depth, $comment->id);
				comment_reply_link(array_merge(
					$a[1],
					array(
						"reply_text" => $a[0],
						"depth" => $a[2],
						"max_depth" => $a[1]["max_depth"]
					)
				), $a[3]); unset($a) ?>
								</span><!-- .reply -->
<?php WpLatteFunctions::editCommentLink(__("Edit", "ait"), $comment->id, "<span class=\"edit-link\">", "</span>") ?>
						</span>

<?php if (!$comment->approved): ?>
							<em class="comment-awaiting-moderation"><?php echo NTemplateHelpers::escapeHtml(__('Your comment is awaiting moderation.', 'ait'), ENT_NOQUOTES) ?></em><br />
<?php endif ?>
						<span class="theRow clearfix">
								<a href="<?php echo htmlSpecialChars($comment->url) ?>" class="comment-date"><!--
								--><time datetime="<?php echo htmlSpecialChars($template->date($comment->date, 'c')) ?>"><!--
									--><?php echo NTemplateHelpers::escapeHtml($template->date($comment->date, $site->dateFormat), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml(_x('at', 'comment publish time', 'ait'), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->date($comment->date, $site->timeFormat), ENT_NOQUOTES) ?><!--
								--></time><!--
							--></a>
								<cite class="fn"><?php echo $comment->author->nameWithLink ?></cite>
						</span>
					</div>
					<div class="comment-text">

						<div class="comment-content">

								<?php echo $comment->content ?>

						</div>
					</div>
				</article><!-- #comment-## -->
<?php endif ;
			$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its);
			echo "</li>";
			echo str_repeat("</ul></li>", $depth - 1);
			if(isset($a["end"]))
				echo $a["end"];
			else
				echo "</ol>" ?>

<?php NCoreMacros::includeTemplate("snippets/comments-pagination.php", array('location' => 'below') + $template->getParams(), $_l->templates['u64g1wb3ht'])->render() ?>

<?php elseif (!$post->hasOpenComments and $post->type != 'page' and $post->hasSupportFor('comments')): ?>

	<p class="nocomments"><?php echo NTemplateHelpers::escapeHtml(__('Comments are closed.', 'ait'), ENT_NOQUOTES) ?></p>

<?php endif ?>

<?php comment_form(array()) ?>

<?php else: ?>
	<p class="nopassword"><?php echo NTemplateHelpers::escapeHtml(__('This post is password protected. Enter the password to view any comments.', 'ait'), ENT_NOQUOTES) ?></p>
<?php endif ;if ($post->comments): ?>
</div><!-- #comments -->
<?php endif ;
