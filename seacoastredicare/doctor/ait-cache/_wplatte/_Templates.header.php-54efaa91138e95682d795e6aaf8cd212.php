<?php //netteCache[01]000480a:2:{s:4:"time";s:21:"0.43160900 1380701473";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:91:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/header.php";i:2;i:1380701461;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/header.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'letpi806ll')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!doctype html>
<html class="no-js" lang="<?php echo htmlSpecialChars($site->language) ?>">
<head>
	<meta charset="<?php echo htmlSpecialChars($site->charset) ?>" />
	
	<meta name="Author" content="AitThemes.com, http://www.ait-themes.com" />

	<title><?php echo WpLatteFunctions::getTitle() ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo htmlSpecialChars($site->pingbackUrl) ?>" />

	<!--[if lte IE 8]>
	<script src="<?php echo NTemplateHelpers::escapeHtmlComment($themeJsUrl) ?>/libs/modernizr-2.6.1-custom.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
	<script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
<?php if(is_singular() && get_option("thread_comments")){wp_enqueue_script("comment-reply");}wp_head() ?>
	<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo WpLatteFunctions::lessify() ?>" />
</head>
<body <?php body_class() ?> data-themeurl="<?php echo NTemplateHelpers::escapeHtml($themeUrl, ENT_NOQUOTES) ?>">
	<header class="clearfix">
		<div class="header-content defaultContentWidth clearfix">
			<div class="logo left clearfix headerleftside">
<?php if (!empty($themeOptions->general->logo_img)): ?>
				<a class="trademark" href="<?php echo htmlSpecialChars($homeUrl) ?>">
					<img src="<?php echo WpLatteFunctions::linkTo($themeOptions->general->logo_img) ?>" alt="logo" />
				</a>
<?php endif ?>
				<div class="table">
<?php if (!empty($themeOptions->general->tagline)): ?>
					<div class="tagLineHolder">
						<p class="left textshadow info"><?php bloginfo('description') ?></p>
					</div>
<?php endif ?>
				</div>
			</div>
			<div class="right cliearfix headerrightside">
           <div class="addressvalue">
                 <div class="cno">Ph#:<a href="tel:603-692-6066">603-692-6066</a><br />Fax:<a href="tel:603-692-4815">603-692-4815</a></div>
                 <div class="adddetail"><a href="https://maps.google.com/maps?q=396,High+Street+Somersworth,NH+03878&oe=utf-8&client=firefox-a&hnear=396+High+St,+Somersworth,+New+Hampshire+03878&gl=us&t=m&z=16" target="blank">396 High Street <div style="padding-top:3px;">Somersworth, NH 03878 </a><a href="mailto:info@seacoastredicare.com">info@seacoastredicare.com</a></div></div>	
           </div>     
           <a href="https://maps.google.com/maps?q=396,High+Street+Somersworth,NH+03878&oe=utf-8&client=firefox-a&hnear=396+High+St,+Somersworth,+New+Hampshire+03878&gl=us&t=m&z=16" target="blank"><div class="addressimg">
            </div></a>
<?php if ($themeOptions->socialIcons->displayIcons): if (isset($themeOptions->socialIcons->icons)): ?>
					<ul id="social-links" class="right clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($themeOptions->socialIcons->icons) as $icon): ?>
						<li><a href="<?php if (!empty($icon->link)): echo htmlSpecialChars($icon->link) ;else: ?>
#<?php endif ?>"><img src="<?php echo htmlSpecialChars($icon->iconUrl) ?>" height="14" width="14" alt="<?php echo htmlSpecialChars($icon->title) ?>
" title="<?php echo htmlSpecialChars($icon->title) ?>" /></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
					</ul>
<?php endif ;endif ?>

<?php if (function_exists('icl_get_languages')): if (icl_get_languages('skip_missing=0')): ?>
					<div id="flags" class="right">
						<div class="flag-selected"></div>
						<ul class="flags-dropdown">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(icl_get_languages('skip_missing=0')) as $lang): ?>
							<li <?php if ($lang['active'] == 1): ?>class="flag-active"<?php endif ?>><a href="<?php echo htmlSpecialChars($lang['url']) ?>
"><?php echo NTemplateHelpers::escapeHtml($lang['language_code'], ENT_NOQUOTES) ?></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
						</ul>
					</div>
<?php endif ;endif ?>

			</div>
		</div>


		<div class="menu-container">
			<div class="menu-content defaultContentWidth">
				<div id="mainmenu-dropdown-duration" style="display: none;">200</div>
				<div id="mainmenu-dropdown-easing" style="display: none;">swing</div>
				<span class="menubut bigbut"><?php echo NTemplateHelpers::escapeHtml(__('Main Menu', 'ait'), ENT_NOQUOTES) ?></span>
<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu')) ?>
				
			</div>
		</div>

<?php if (isset($post) && isset($post->options('slider')->overrideGlobal)): if (function_exists('putRevSlider')): if ($post->options('slider')->sliderEnable == true): ?>
					<div class="slider-container slider-enabled">
<?php else: ?>
					<div class="slider-container slider-disabled">
<?php endif ;else: ?>
				<div class="slider-container slider-disabled">
<?php endif ;else: if (function_exists('putRevSlider')): if ($themeOptions->sections->sliderEnable == true): ?>
					<div class="slider-container slider-enabled">
<?php else: ?>
					<div class="slider-container slider-disabled">
<?php endif ;else: ?>
				<div class="slider-container slider-disabled">
<?php endif ;endif ?>

			<div class="wrapper">
<?php if (isset($post) && isset($post->options('slider')->overrideGlobal)): if (function_exists('putRevSlider')): NCoreMacros::includeTemplate("snippets/slider.php", array('options' => $post->options('slider')) + $template->getParams(), $_l->templates['letpi806ll'])->render() ;if ($post->options('slider')->sliderEnable == true): NCoreMacros::includeTemplate("snippets/office-information.php", array('options' => $themeOptions->officeInformation) + $template->getParams(), $_l->templates['letpi806ll'])->render() ;endif ;endif ;else: if (function_exists('putRevSlider')): NCoreMacros::includeTemplate("snippets/slider.php", array('options' => $themeOptions->sections) + $template->getParams(), $_l->templates['letpi806ll'])->render() ;if ($themeOptions->sections->sliderEnable == true): NCoreMacros::includeTemplate("snippets/office-information.php", array('options' => $themeOptions->officeInformation) + $template->getParams(), $_l->templates['letpi806ll'])->render() ;endif ;endif ;endif ?>
			</div>
		</div>
	</header>	