<?php //netteCache[01]000488a:2:{s:4:"time";s:21:"0.54498900 1377791379";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:99:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/page-fullwidth.php";i:2;i:1377786858;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/page-fullwidth.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '73jbl590ik')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb983017bd36_content')) { function _lb983017bd36_content($_l, $_args) { extract($_args)
?>

<div id="container" class="subpage defaultContentWidth clear onecolumn" <?php if (isset($post) && isset($post->options('content')->overrideGlobal)): ?>
style="background-color: <?php echo $post->options('content')->localContentColor ?>
"<?php endif ?>>
	<div id="content" class="mainbar entry-content clearfix">
		<div id="content-wrapper">
			<h1><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></h1>

<?php if ($post->thumbnailSrc): ?>
			<div class="entry-thumbnail">
				<img src="<?php echo AitImageResizer::resize($post->thumbnailSrc, array('w' => 640, 'h' => 200)) ?>" alt="" />
			</div>
<?php endif ?>

			<?php echo $post->content ?>


<?php NCoreMacros::includeTemplate("comments.php", $template->getParams(), $_l->templates['73jbl590ik'])->render() ?>

		</div>
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
if (!function_exists($_l->blocks[$sectionA][] = '_lb881773d0bc__sectionA')) { function _lb881773d0bc__sectionA($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/testimonials.php", array('options' => $post->options('testimonials')) + $template->getParams(), $_l->templates['73jbl590ik'])->render() ;}} call_user_func(reset($_l->blocks[$sectionA]), $_l, get_defined_vars()) ?>

<?php isset($post->options('service-boxes')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xa' ;//
// block $sectionB
//
if (!function_exists($_l->blocks[$sectionB][] = '_lb22066e4e95__sectionB')) { function _lb22066e4e95__sectionB($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/service-boxes.php", array('options' => $post->options('service-boxes')) + $template->getParams(), $_l->templates['73jbl590ik'])->render() ;}} call_user_func(reset($_l->blocks[$sectionB]), $_l, get_defined_vars()) ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
