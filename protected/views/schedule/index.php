<h2>Weekly schedule</h2>
<style>
	.fc-event-container {
		cursor: pointer;
	}
</style>
<script type="text/javascript">
	function selectHandler(start, end) {
		var $calendar = $('#weekCalendar');
		var eventData;
		bootbox.confirm({
			message: 'From ' + start.format('dddd[,] h:mm a') + ' till ' + end.format('dddd[,] h:mm a'),
			title: "Are you sure that you will be available at this time?",
			callback: function (result) {
				if (result) {
					eventData = {
						title: 'Available',
						start: start,
						end: end
					};
					$.ajax({
						url: '/schedule/create',
						data: {
							startTime: start.format('E[:]HH:mm'),
							endTime: end.format('E[:]HH:mm')
						},
						success: function (data) {
							$calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
						}
					});
				}
				$calendar.fullCalendar('unselect');
			},
			buttons: {
				confirm: {
					label: "Confirm!",
					className: "btn-success"
				}

			}
		});
	}
	function eventClickHandler(event, jsEvent, view)
	{
		bootbox.confirm({
			title: "Are you sure you to delete this time frame?",
			message :"From " +  event.start.format('dddd[,] h:mm a') + " till " + event.end.format('dddd[,] h:mm a'),
			callback: function (result) {
				if (result) {
					$.ajax({
						url:'/schedule/delete',
						data:{
							startTime:event.start.format('E[:]HH:mm'),
							endTime:event.end.format('E[:]HH:mm')
						},
						success : function(data)
						{
							$('#weekCalendar').fullCalendar('removeEvents', event._id);
						}
					});
				}
			},
			buttons: {
				confirm: {
					label: "Confirm!",
					className: "btn-danger"
				}

			}
		});
	}
</script>
<?php
$this->widget('ext.EFullCalendar.EFullCalendar', array(

	'themeCssFile' => 'cupertino/theme.css',
	'id' => 'weekCalendar',
	'htmlOptions' => array(
		// you can scale it down as well, try 80%
		'style' => 'width:80%',

	),
	'initScript' => new CJavaScriptExpression("
		$('.fc-today').removeClass('ui-state-highlight');
	"),
	// FullCalendar's options.
	// Documentation available at
	// http://arshaw.com/fullcalendar/docs/
	'options' => array(
		'header' => array(

		),
		'firstDay' => 1,
		'defaultView' => 'agendaWeek',
		'columnFormat' => array(
			'week' => 'dddd'
		),
		'selectable' => true,
		'selectHelper' => true,
		'select' => new CJavaScriptExpression("
		selectHandler

		"),
		'lazyFetching' => true,
		'eventSources' => array(
			array( // checks weekly schedule
				'url' => CHtml::normalizeUrl(array('my')),
			),
		),
		'eventClick' => new CJavaScriptExpression("eventClickHandler"),
	)
));
?>
