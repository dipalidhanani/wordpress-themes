<?php //netteCache[01]000480a:2:{s:4:"time";s:21:"0.77726300 1377788863";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:91:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/footer.php";i:2;i:1377786856;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/footer.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'gnorfv3895')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
				<footer class="page-footer">
<?php if(is_active_sidebar("footer-widgets")): ?>
					<aside class="footer-widgets clearfix">
						<div class="wrapper">
<?php dynamic_sidebar('footer-widgets') ?>
						</div>
					</aside>
<?php endif ?>

					<aside class="footer-line clearfix">
					<div class="wrapper clearfix">
						<div class="footer-text left"><?php echo $themeOptions->general->footer_text ?></div>
						<div class="footer-menu right clearfix">
<?php wp_nav_menu(array('theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1)) ?>
						</div>
					</div>	
					</aside>
				</footer>
<?php wp_footer() ?>

		<script type="text/javascript">
<?php if (isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")): ?>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', <?php echo NTemplateHelpers::escapeJs($themeOptions->general->ga_code) ?>]);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
<?php endif ?>
		</script>
	</body>
</html>