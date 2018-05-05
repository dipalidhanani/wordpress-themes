<!doctype html>
<html class="no-js" lang="{$site->language}">
<head>
	<meta charset="{$site->charset}">
	
	<meta name="Author" content="AitThemes.com, http://www.ait-themes.com">

	<title>{title}</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{$site->pingbackUrl}">

	<!--[if lte IE 8]>
	<script src="{$themeJsUrl}/libs/modernizr-2.6.1-custom.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
	<script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
	{head}
	<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="{less}">
</head>
<body <?php body_class(); ?> data-themeurl="{$themeUrl}">
	<header class="clearfix">
		<div class="header-content defaultContentWidth clearfix">
			<div class="logo left clearfix headerleftside">
				{if !empty($themeOptions->general->logo_img)}
				<a class="trademark" href="{$homeUrl}">
					<img src="{linkTo $themeOptions->general->logo_img}" alt="logo">
				</a>
				{/if}
				<div class="table">
				{if !empty($themeOptions->general->tagline)}
					<div class="tagLineHolder">
						<p class="left textshadow info"><?php bloginfo('description'); ?></p>
					</div>
				{/if}
				</div>
			</div>
			<div class="right cliearfix headerrightside">
           <div class="addressvalue">
                 <div class="cno">Ph#:<a href="tel:603-692-6066">603-692-6066</a><br>Fax:<a href="tel:603-692-4815">603-692-4815</a></div>
                 <div class="adddetail"><a href="https://maps.google.com/maps?q=396,High+Street+Somersworth,NH+03878&oe=utf-8&client=firefox-a&hnear=396+High+St,+Somersworth,+New+Hampshire+03878&gl=us&t=m&z=16" target="blank">396 High Street <div style="padding-top:3px;">Somersworth, NH 03878 </a><a href="mailto:info@seacoastredicare.com">info@seacoastredicare.com</a></div></div>	
           </div>     
           <a href="https://maps.google.com/maps?q=396,High+Street+Somersworth,NH+03878&oe=utf-8&client=firefox-a&hnear=396+High+St,+Somersworth,+New+Hampshire+03878&gl=us&t=m&z=16" target="blank"><div class="addressimg">
            </div></a>
				{if $themeOptions->socialIcons->displayIcons}
					{ifset $themeOptions->socialIcons->icons}
					<ul id="social-links" class="right clearfix">
						{foreach $themeOptions->socialIcons->icons as $icon}
						<li><a href="{if !empty($icon->link)}{$icon->link}{else}#{/if}"><img src="{$icon->iconUrl}" height="14" width="14" alt="{$icon->title}" title="{$icon->title}"></a></li>
						{/foreach}
					</ul>
					{/ifset}
				{/if}

				{if function_exists(icl_get_languages)}
					{if icl_get_languages('skip_missing=0')}
					<div id="flags" class="right">
						<div class="flag-selected"></div>
						<ul class="flags-dropdown">
						{foreach icl_get_languages('skip_missing=0') as $lang}
							<li {if $lang['active'] == 1}class="flag-active"{/if}><a href="{$lang['url']}">{$lang['language_code']}</a></li>
						{/foreach}
						</ul>
					</div>
					{/if}
				{/if}

			</div>
		</div>


		<div class="menu-container">
			<div class="menu-content defaultContentWidth">
				<div id="mainmenu-dropdown-duration" style="display: none;">200</div>
				<div id="mainmenu-dropdown-easing" style="display: none;">swing</div>
				<span class="menubut bigbut">{__ 'Main Menu'}</span>
				{menu 'theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu' }
				
			</div>
		</div>

		{if isset($post) && isset($post->options('slider')->overrideGlobal)}
			{if function_exists('putRevSlider')}
				{if $post->options('slider')->sliderEnable == true}
					<div class="slider-container slider-enabled">
				{else}
					<div class="slider-container slider-disabled">
				{/if}
			{else}
				<div class="slider-container slider-disabled">
			{/if}
		{else}
			{if function_exists('putRevSlider')}
				{if $themeOptions->sections->sliderEnable == true}
					<div class="slider-container slider-enabled">
				{else}
					<div class="slider-container slider-disabled">
				{/if}
			{else}
				<div class="slider-container slider-disabled">
			{/if}
		{/if}

			<div class="wrapper">
			{if isset($post) && isset($post->options('slider')->overrideGlobal)}
				{if function_exists('putRevSlider')}
					{include snippets/slider.php, options => $post->options('slider')}
					{if $post->options('slider')->sliderEnable == true}
						{include snippets/office-information.php, options => $themeOptions->officeInformation}
					{/if}
				{/if}
			{else}
				{if function_exists('putRevSlider')}
					{include snippets/slider.php, options => $themeOptions->sections}
					{if $themeOptions->sections->sliderEnable == true}
						{include snippets/office-information.php, options => $themeOptions->officeInformation}
					{/if}
				{/if}
			{/if}
			</div>
		</div>
	</header>	