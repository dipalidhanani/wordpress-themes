<?php //netteCache[01]000477a:2:{s:4:"time";s:21:"0.39544300 1377791460";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:88:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/404.php";i:2;i:1377786854;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/404.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'xppbuwp7pz')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbfaf02f600b_content')) { function _lbfaf02f600b_content($_l, $_args) { extract($_args)
?>

<!-- SUBPAGE -->
<div id="container" class="defaultContentWidth subpage subpage-line clearfix clear <?php if(!is_active_sidebar("subpages-sidebar")): ?>
onecolumn<?php endif ?>">
	<!-- MAINBAR -->
		<div class="wrapper">
			<div id="content" class="mainbar entry-content onecolumn">
					<h1><?php echo NTemplateHelpers::escapeHtml(__('Not found', 'ait'), ENT_NOQUOTES) ?></h1>
					<h1><?php echo NTemplateHelpers::escapeHtml(__("This is somewhat embarrassing, isn't it?", 'ait'), ENT_NOQUOTES) ?></h1>

					<p><?php echo NTemplateHelpers::escapeHtml(__("It seems we can't find what you are looking for. Perhaps searching, or one of the links below, can help.", 'ait'), ENT_NOQUOTES) ?></p>

					<form action="<?php echo htmlSpecialChars($homeUrl) ?>" id="search" method="get">
					<div>

						<input type="submit" name="submit"  value="Search" />
						<input type="text" name="s" placeholder="search..." />

					</div>
					</form>
			</div>
<?php if(is_active_sidebar("subpages-sidebar")): ?>
			<div class="sidebar right clearfix">
<?php dynamic_sidebar('subpages-sidebar') ?>
			</div>
<?php endif ?>
		</div>
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
