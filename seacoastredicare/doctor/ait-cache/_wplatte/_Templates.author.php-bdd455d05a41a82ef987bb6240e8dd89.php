<?php //netteCache[01]000480a:2:{s:4:"time";s:21:"0.71998700 1385975526";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:91:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/author.php";i:2;i:1377786855;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/author.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'cnqho8bmpb')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb64faf811d7_content')) { function _lb64faf811d7_content($_l, $_args) { extract($_args)
?>

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clear <?php if(!is_active_sidebar("blog-sidebar")): ?>
onecolumn<?php endif ?>">
	<!-- MAINBAR -->
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">

<?php if ($posts): ?>

					<h1 class="page-title author">
						<?php echo NTemplateHelpers::escapeHtml(__('Author Archives:', 'ait'), ENT_NOQUOTES) ?>

						<span class="vcard">
							<a href="<?php echo htmlSpecialChars($author->postsUrl) ?>" title="<?php echo htmlSpecialChars($author->name) ?>
" rel="me"><?php echo NTemplateHelpers::escapeHtml($author->name, ENT_NOQUOTES) ?></a>
						</span>
					</h1>


<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['cnqho8bmpb'])->render() ?>

<?php if (!empty($author->bio)): ?>
					<div id="author-info">
						<div id="author-avatar">
							<?php echo NTemplateHelpers::escapeHtml($author->avatar(60), ENT_NOQUOTES) ?>

						</div><!-- #author-avatar -->
						<div id="author-description">
							<?php echo NTemplateHelpers::escapeHtml(__('About', 'ait'), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($author->name, ENT_NOQUOTES) ?>

							<?php echo NTemplateHelpers::escapeHtml($author->bio, ENT_NOQUOTES) ?>

						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
<?php endif ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['cnqho8bmpb'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['cnqho8bmpb'])->render() ?>

<?php else: ?>

					<article id="post-0" class="post no-results not-found">

						<h1 class="entry-title"><?php echo NTemplateHelpers::escapeHtml(__('Nothing Found', 'ait'), ENT_NOQUOTES) ?></h1>

						<div class="entry-content">
							<p><?php echo NTemplateHelpers::escapeHtml(__('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post', 'ait'), ENT_NOQUOTES) ?></p>
<?php NCoreMacros::includeTemplate("snippets/search-form.php", $template->getParams(), $_l->templates['cnqho8bmpb'])->render() ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

<?php endif ?>

		</div><!-- end of mainbar -->

		<!-- SIDEBAR -->
<?php if(is_active_sidebar("blog-sidebar")): ?>
		<div class="sidebar right clearfix">

<?php dynamic_sidebar('blog-sidebar') ?>

		</div><!-- end of sidebar -->
<?php endif ?>
	</div><!-- end of -wrapper -->
</div><!-- end of container -->
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = true; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
$_l->extends = $layout ?>

<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
