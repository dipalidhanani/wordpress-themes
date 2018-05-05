<?php //netteCache[01]000490a:2:{s:4:"time";s:21:"0.82383700 1380211418";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:100:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/snippets/slider.php";i:2;i:1380211398;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/snippets/slider.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '0o0l2b39a5')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($options->sliderEnable == 1): if ($options->sliderAliases != 'null'): ?>
		<div class="slider-content">
<?php if (isset($options->sliderAlternative)): ?>
			<div class="slider-alternative" style="display: none">
            	<img src="http://seacoast.newmayodesigns.com/wp-content/uploads/2013/09/seacoastexterior.jpg" alt="alternative" />
				<!--<img src="<?php if ($options->sliderAlternative): echo NTemplateHelpers::escapeHtmlComment($options->sliderAlternative) ;else: ?>
#<?php endif ?>" alt="alternative" />-->
			</div>
<?php endif ;if (function_exists('putRevSlider')): ?>
			<?php echo NTemplateHelpers::escapeHtml(putRevSlider($options->sliderAliases), ENT_NOQUOTES) ?>

<?php endif ?>
		</div>
<?php endif ;endif ;
