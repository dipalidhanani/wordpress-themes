<?php //netteCache[01]000497a:2:{s:4:"time";s:21:"0.44057100 1377788863";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:107:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/snippets/service-boxes.php";i:2;i:1377786869;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/snippets/service-boxes.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'fn019krge2')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if (isset($options->serviceBoxesDisplay) and $options->serviceBoxesDisplay): $serviceBoxes = $site->create('service-box', $options->serviceBoxesCategory) ;if ($serviceBoxes): ?>
	<section class="section sboxes-section sboxes-<?php echo htmlSpecialChars($options->serviceBoxesInRow) ?>">
		<div class="clearfix service-boxes-container entry-content wrapper">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($serviceBoxes) as $serviceBox): ?>
				<div class="clearfix sbox sbox<?php echo htmlSpecialChars($iterator->counter) ?>
 <?php if ($iterator->first): ?>first-sbox<?php elseif ($iterator->last): ?>last-sbox<?php endif ?>"
				style="width: <?php if (isset($box->options->boxWidth)): echo htmlSpecialChars(NTemplateHelpers::escapeCss($box->options->boxWidth)) ;echo $sboxesWidth ?>
px<?php endif ?>;">
					<div class="sbox-wrap">
						<div class="sbox-content clear clearfix">
							<a href="<?php echo htmlSpecialChars($serviceBox->options->boxLink) ?>" class="iconLink">
<?php if (isset($serviceBox->options->boxHoverImage)): ?>
								<span class="wrap1"><img class="hoverImage ico" src="<?php echo htmlSpecialChars($serviceBox->thumbnailSrc) ?>
" alt="<?php echo htmlSpecialChars($serviceBox->title) ?>" /></span><span class="wrap2"><img class="hoverImage ico" src="<?php echo htmlSpecialChars($serviceBox->options->boxHoverImage) ?>
" alt="<?php echo htmlSpecialChars($serviceBox->title) ?>" /></span>
<?php else: ?>
								<span class="wrap1"><img src="<?php echo htmlSpecialChars($serviceBox->thumbnailSrc) ?>
" alt="<?php echo htmlSpecialChars($serviceBox->title) ?>" class="ico" /></span>
<?php endif ?>
							</a>
							<h2 class="title">
								<span class="title-text"><?php echo NTemplateHelpers::escapeHtml($serviceBox->title, ENT_NOQUOTES) ?></span>
							</h2>
							<p><?php echo NTemplateHelpers::escapeHtml($serviceBox->options->boxText, ENT_NOQUOTES) ?></p>
<?php if (isset($serviceBox->options->boxMoreText)): ?>
								<a href="<?php echo htmlSpecialChars($serviceBox->options->boxLink) ?>" class="more">
									<span><?php echo NTemplateHelpers::escapeHtml($serviceBox->options->boxMoreText, ENT_NOQUOTES) ?></span>
								</a>
<?php endif ?>
						</div>
					</div>
				</div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		</div>
	</section>
<?php endif ;endif ;
