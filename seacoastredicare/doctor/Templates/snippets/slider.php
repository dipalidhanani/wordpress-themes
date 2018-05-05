{if $options->sliderEnable == 1}
	{if $options->sliderAliases != 'null'}
		<div class="slider-content">
		{if isset($options->sliderAlternative)}
			<div class="slider-alternative" style="display: none">
            	<img src="http://seacoast.newmayodesigns.com/wp-content/uploads/2013/09/seacoastexterior.jpg" alt="alternative" />
				<!--<img src="{if $options->sliderAlternative}{$options->sliderAlternative}{else}#{/if}" alt="alternative" />-->
			</div>
		{/if}
		{if function_exists('putRevSlider')}
			{putRevSlider($options->sliderAliases)}
		{/if}
		</div>
	{/if}
{/if}