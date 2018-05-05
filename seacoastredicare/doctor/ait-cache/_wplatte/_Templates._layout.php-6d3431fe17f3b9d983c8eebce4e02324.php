<?php //netteCache[01]000481a:2:{s:4:"time";s:21:"0.48653100 1377788863";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:92:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/@layout.php";i:2;i:1377786855;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/@layout.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '07wjiyakxn')
;//
// block sectionA
//
if (!function_exists($_l->blocks['sectionA'][] = '_lb9c1ac9d38c_sectionA')) { function _lb9c1ac9d38c_sectionA($_l, $_args) { extract($_args)
;NCoreMacros::includeTemplate("snippets/testimonials.php", array('options' => $themeOptions->sections) + $template->getParams(), $_l->templates['07wjiyakxn'])->render() ;
}}

//
// block sectionB
//
if (!function_exists($_l->blocks['sectionB'][] = '_lb4f07e74e5e_sectionB')) { function _lb4f07e74e5e_sectionB($_l, $_args) { extract($_args)
;NCoreMacros::includeTemplate("snippets/service-boxes.php", array('options' => $themeOptions->sections) + $template->getParams(), $_l->templates['07wjiyakxn'])->render() ;
}}

//
// block sectionC
//
if (!function_exists($_l->blocks['sectionC'][] = '_lbe8ec6942b4_sectionC')) { function _lbe8ec6942b4_sectionC($_l, $_args) { extract($_args)
;NUIMacros::callBlock($_l, 'content', $template->getParams()) ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extends) ? FALSE : $template->_extends; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
get_header("") ?>

<div id="sections">




	<?php if (!isset($sectionsOrder)): ?> <?php $sectionsOrder = $themeOptions->sections->sectionsOrder ?>
 <?php endif ?>


<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($sectionsOrder) as $section): NUIMacros::callBlock($_l, $section, $template->getParams()) ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

</div>

<?php get_footer("") ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
