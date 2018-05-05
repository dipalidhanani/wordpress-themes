{getHeader}

<div id="sections">

	{define sectionA}
		{include snippets/testimonials.php, options => $themeOptions->sections}
	{/define}

	{define sectionB}
		{include snippets/service-boxes.php, options => $themeOptions->sections}
	{/define}

    {define sectionC}
        {include #content}
    {/define}

	{if !isset($sectionsOrder)} {var $sectionsOrder = $themeOptions->sections->sectionsOrder} {/if}

	{foreach $sectionsOrder as $section}
		{include #$section}
	{/foreach}

</div>

{getFooter}