<?php //netteCache[01]000482a:2:{s:4:"time";s:21:"0.77860800 1379663757";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/homepage.php";i:2;i:1379586504;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/homepage.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '1lbpleu4nc')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe05874e359_content')) { function _lbe05874e359_content($_l, $_args) { extract($_args)
?>
<div id="container" class="home abc subpage clear <?php if(is_active_sidebar("homepage")): ?>
twocolumn<?php else: ?>onecolumn<?php endif ?>" <?php if (isset($post) && isset($post->options('content')->overrideGlobal)): ?>
style="background-color: <?php echo $post->options('content')->localContentColor ?>
"<?php endif ?>>
<?php if (trim($post->content) != ""): ?>
	<div id="content" class="mainbar entry-content clearfix ">
		<?php echo $post->content ?>

	</div>

<?php if(is_active_sidebar("homepage-sidebar")): ?>
		<div class="sidebar right clearfix">
<?php dynamic_sidebar('homepage-sidebar') ?>
		</div>
<?php endif; endif ?>
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
$_l->extends = $layout ;$sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->sectionsOrder : null  ?>

<?php isset($post->options('testimonials')->overrideGlobal) ? $sectionA = 'sectionA' : $sectionA = 'xa' ;//
// block $sectionA
//
if (!function_exists($_l->blocks[$sectionA][] = '_lb4a52ad7bad__sectionA')) { function _lb4a52ad7bad__sectionA($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/testimonials.php", array('options' => $post->options('testimonials')) + $template->getParams(), $_l->templates['1lbpleu4nc'])->render() ;}} call_user_func(reset($_l->blocks[$sectionA]), $_l, get_defined_vars()) ?>

<?php isset($post->options('service-boxes')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb' ;//
// block $sectionB
//
if (!function_exists($_l->blocks[$sectionB][] = '_lbc5f74fc292__sectionB')) { function _lbc5f74fc292__sectionB($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/service-boxes.php", array('options' => $post->options('service-boxes')) + $template->getParams(), $_l->templates['1lbpleu4nc'])->render() ;}} call_user_func(reset($_l->blocks[$sectionB]), $_l, get_defined_vars()) ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
