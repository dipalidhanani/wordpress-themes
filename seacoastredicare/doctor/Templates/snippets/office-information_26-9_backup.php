<div class="office-info">
	
	<div class="office-hours">
		<span class="office-info-icon"></span>
		<span class="office-info-title"></span>
		<div class="timetable">
        <div class="office-info-title1">{__ 'Office Hours'}</div>
        
        
			<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_sunday : $day_data = $options->day_monday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Sun'}</div>{else}<div class="timetable-day">{__ 'Monday'}-{__ 'Friday'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>
			<!--<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_monday : $day_data = $options->day_tuesday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Mon'}</div>{else}<div class="timetable-day">{__ 'Tue'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>
			<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_tuesday : $day_data = $options->day_wednesday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Tue'}</div>{else}<div class="timetable-day">{__ 'Wed'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>
			<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_wednesday : $day_data = $options->day_thursday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Wed'}</div>{else}<div class="timetable-day">{__ 'Thu'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>
			<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_thursday : $day_data = $options->day_friday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Thu'}</div>{else}<div class="timetable-day">{__ 'Fri'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>-->
			<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_friday : $day_data = $options->day_saturday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Fri'}</div>{else}<div class="timetable-day">{__ 'saturday'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>
			<div class="timetable-entry">
				{? get_option('start_of_week') == 0 ? $day_data = $options->day_saturday : $day_data = $options->day_sunday}
				{if get_option('start_of_week') == 0}<div class="timetable-day">{__ 'Sat'}</div>{else}<div class="timetable-day">{__ 'Sunday'}</div>{/if}
				<div class="timetable-time">{$day_data}</div>
			</div>
		</div>
	</div>
	
	{if $options->officeContactDisplay}
	<div class="office-telephone clearfix">
		<span class="office-info-icon"></span>
		<span class="office-info-title">{__ 'Call'}</span>
		<span class="office-info-data">{$options->phone_number}</span>


	</div>

	<div class="office-email clearfix">
		<span class="office-info-icon"></span>
		<span class="office-info-title">{__ 'email'}</span>
		<span class="office-info-data">{$options->email}</span>
	</div>
	{/if}
</div>