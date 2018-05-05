{if isset($options->serviceBoxesDisplay) and $options->serviceBoxesDisplay}
	{var $serviceBoxes = $site->create('service-box', $options->serviceBoxesCategory)}
	{if $serviceBoxes}
	<section class="section sboxes-section sboxes-{$options->serviceBoxesInRow}">
		<div class="clearfix service-boxes-container entry-content wrapper">
			{foreach $serviceBoxes as $serviceBox}
				<div class="clearfix sbox sbox{$iterator->counter} {if $iterator->first}first-sbox{elseif $iterator->last}last-sbox{/if}"
				style="width: {ifset $box->options->boxWidth}{$box->options->boxWidth}{!$sboxesWidth}px{/ifset};">
					<div class="sbox-wrap">
						<div class="sbox-content clear clearfix">
							<a href="{$serviceBox->options->boxLink}" class="iconLink">
								{if isset($serviceBox->options->boxHoverImage)}
								<span class="wrap1"><img class="hoverImage ico" src="{$serviceBox->thumbnailSrc}" alt="{$serviceBox->title}" /></span><span class="wrap2"><img class="hoverImage ico" src="{$serviceBox->options->boxHoverImage}" alt="{$serviceBox->title}" /></span>
								{else}
								<span class="wrap1"><img src="{$serviceBox->thumbnailSrc}" alt="{$serviceBox->title}" class="ico" /></span>
								{/if}
							</a>
							<h2 class="title">
								<span class="title-text">{$serviceBox->title}</span>
							</h2>
							<p>{$serviceBox->options->boxText}</p>
							{if isset($serviceBox->options->boxMoreText)}
								<a href="{$serviceBox->options->boxLink}" class="more">
									<span>{$serviceBox->options->boxMoreText}</span>
								</a>
							{/if}
						</div>
					</div>
				</div>
			{/foreach}
		</div>
	</section>
	{/if}
{/if}