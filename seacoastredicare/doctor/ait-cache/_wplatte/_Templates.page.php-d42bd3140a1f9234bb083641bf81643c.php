<?php //netteCache[01]000478a:2:{s:4:"time";s:21:"0.82797300 1380289738";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:89:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/page.php";i:2;i:1380289648;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/page.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '6vw2c9xrtj')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb695c586ee1_content')) { function _lb695c586ee1_content($_l, $_args) { extract($_args)
?>

<div id="container" class="subpage subpage-line clear clearfix <?php if(!is_active_sidebar("subpages-sidebar")): ?>
onecolumn<?php endif ?>" <?php if (isset($post) && isset($post->options('content')->overrideGlobal)): ?>
style="background-color: <?php echo $post->options('content')->localContentColor ?>
"<?php endif ?>>
	<div class="wrapper">
		<div id="content" class="mainbar entry-content clearfix">
			<div class="<?php if(is_active_sidebar("subpages")): ?>left leftContent<?php else: ?>
content<?php endif ?>">
				<h1 class="title1"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></h1>
				<div class="toolbar">
					<div id="breadcrumb"><?php echo NTemplateHelpers::escapeHtml(__('You are here:', 'ait'), ENT_NOQUOTES) ?>
 <?php echo WpLatteFunctions::breadcrumbs(array()) ?></div>
				</div>
				<?php echo $post->content ?>

			</div>
<?php NCoreMacros::includeTemplate("comments.php", $template->getParams(), $_l->templates['6vw2c9xrtj'])->render() ?>
		</div>

<?php if(is_active_sidebar("subpages-sidebar")): ?>
		<div class="sidebar right clearfix">

<?php if (isset($post)): if (isset($post->options('slider')->overrideGlobal) && $post->options('slider')->overrideGlobal): if ($post->options('slider')->sliderEnable == false): NCoreMacros::includeTemplate("snippets/office-information.php", array('options' => $themeOptions->officeInformation) + $template->getParams(), $_l->templates['6vw2c9xrtj'])->render() ;endif ;else: if ($themeOptions->sections->sliderEnable == false): NCoreMacros::includeTemplate("snippets/office-information.php", array('options' => $themeOptions->officeInformation) + $template->getParams(), $_l->templates['6vw2c9xrtj'])->render() ;endif ;endif ;endif ?>

<?php if ($post->thumbnailSrc != false): ?>
			<div class="entry-thumbnail sidebar-image">
				<a href="<?php echo htmlSpecialChars($post->thumbnailSrc) ?>" title="">
					<?php echo $post->thumbnail ?>

				</a>
			</div>
<?php endif ;dynamic_sidebar('subpages-sidebar') ?>
		</div>
<?php endif ?>
	</div>
</div>
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
$_l->extends = $layout ;$sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null ?>


<?php isset($post->options('testimonials')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xb' ;//
// block $sectionA
//
if (!function_exists($_l->blocks[$sectionA][] = '_lb1937f572a7__sectionA')) { function _lb1937f572a7__sectionA($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/testimonials.php", array('options' => $post->options('testimonials')) + $template->getParams(), $_l->templates['6vw2c9xrtj'])->render() ;}} call_user_func(reset($_l->blocks[$sectionA]), $_l, get_defined_vars()) ?>

<?php isset($post->options('service-boxes')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xa' ;//
// block $sectionB
//
if (!function_exists($_l->blocks[$sectionB][] = '_lbb7de093407__sectionB')) { function _lbb7de093407__sectionB($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/service-boxes.php", array('options' => $post->options('service-boxes')) + $template->getParams(), $_l->templates['6vw2c9xrtj'])->render() ;}} call_user_func(reset($_l->blocks[$sectionB]), $_l, get_defined_vars()) ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
