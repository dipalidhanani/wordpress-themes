<?php //netteCache[01]000502a:2:{s:4:"time";s:21:"0.35826600 1380143003";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:112:"/var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/snippets/office-information.php";i:2;i:1380142999;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /var/www/vhosts/seacoastredicare.com/httpdocs/wp-content/themes/doctor/Templates/snippets/office-information.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'tem5f7kui2')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<div class="office-info">
	
    <div class="office-hours">
		
        <div class="announcement">
	        <div class="announcement-title1"><?php echo NTemplateHelpers::escapeHtml(__('ANNOUNCEMENTS', 'ait'), ENT_NOQUOTES) ?></div>
            <div class="announcement-text"><?php dynamic_sidebar( 'announcement-widgets' ) ?></div>
        </div>
        
        <!--<span class="office-info-icon"></span>
		<span class="office-info-title"></span>-->
		<div class="timetable">
        <div class="office-info-title1"><?php echo NTemplateHelpers::escapeHtml(__('Office Hours', 'ait'), ENT_NOQUOTES) ?></div>
        
        
			<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_sunday : $day_data = $options->day_monday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtml(__('Sun', 'ait'), ENT_NOQUOTES) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtml(__('Monday', 'ait'), ENT_NOQUOTES) ?>
-<?php echo NTemplateHelpers::escapeHtml(__('Friday', 'ait'), ENT_NOQUOTES) ?></div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtml($day_data, ENT_NOQUOTES) ?></div>
			</div>
			<!--<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_monday : $day_data = $options->day_tuesday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Mon', 'ait')) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Tue', 'ait')) ?>
</div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtmlComment($day_data) ?></div>
			</div>
			<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_tuesday : $day_data = $options->day_wednesday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Tue', 'ait')) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Wed', 'ait')) ?>
</div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtmlComment($day_data) ?></div>
			</div>
			<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_wednesday : $day_data = $options->day_thursday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Wed', 'ait')) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Thu', 'ait')) ?>
</div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtmlComment($day_data) ?></div>
			</div>
			<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_thursday : $day_data = $options->day_friday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Thu', 'ait')) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtmlComment(__('Fri', 'ait')) ?>
</div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtmlComment($day_data) ?></div>
			</div>-->
			<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_friday : $day_data = $options->day_saturday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtml(__('Fri', 'ait'), ENT_NOQUOTES) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtml(__('saturday', 'ait'), ENT_NOQUOTES) ?>
</div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtml($day_data, ENT_NOQUOTES) ?></div>
			</div>
			<div class="timetable-entry">
<?php get_option('start_of_week') == 0 ? $day_data = $options->day_saturday : $day_data = $options->day_sunday ?>
				<?php if (get_option('start_of_week') == 0): ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtml(__('Sat', 'ait'), ENT_NOQUOTES) ?>
</div><?php else: ?><div class="timetable-day"><?php echo NTemplateHelpers::escapeHtml(__('Sunday', 'ait'), ENT_NOQUOTES) ?>
</div><?php endif ?>

				<div class="timetable-time"><?php echo NTemplateHelpers::escapeHtml($day_data, ENT_NOQUOTES) ?></div>
			</div>
		</div>
	</div>
	
<?php if ($options->officeContactDisplay): ?>
	<div class="office-telephone clearfix">
		<span class="office-info-icon"></span>
		<span class="office-info-title"><?php echo NTemplateHelpers::escapeHtml(__('Call', 'ait'), ENT_NOQUOTES) ?></span>
		<span class="office-info-data"><a href="callto:<?php echo htmlSpecialChars($options->phone_number) ?>
"><?php echo NTemplateHelpers::escapeHtml($options->phone_number, ENT_NOQUOTES) ?></a></span>


	</div>

	<div class="office-email clearfix">
		<span class="office-info-icon"></span>
		<span class="office-info-title"><?php echo NTemplateHelpers::escapeHtml(__('email', 'ait'), ENT_NOQUOTES) ?></span>
		<span class="office-info-data"><a href="mailto:<?php echo htmlSpecialChars($options->email) ?>
"><?php echo NTemplateHelpers::escapeHtml($options->email, ENT_NOQUOTES) ?></a></span>
	</div>
<?php endif ?>
</div>