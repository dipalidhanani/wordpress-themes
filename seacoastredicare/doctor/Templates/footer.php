				<footer class="page-footer">
					{isActiveSidebar footer-widgets}
					<aside class="footer-widgets clearfix">
						<div class="wrapper">
							{dynamicSidebar footer-widgets}
						</div>
					</aside>
					{/isActiveSidebar}

					<aside class="footer-line clearfix">
					<div class="wrapper clearfix">
						<div class="footer-text left">{!$themeOptions->general->footer_text}</div>
						<div class="footer-menu right clearfix">
							{menu 'theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1 }
						</div>
					</div>	
					</aside>
				</footer>
		{footer}

		<script type="text/javascript">
		{if isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")}
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', {$themeOptions->general->ga_code}]);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		{/if}
		</script>
	</body>
</html>