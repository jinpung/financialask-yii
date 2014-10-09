<script type="application/javascript">
function eventClickHandler(event, jsEvent, view)
{
	if(!isNaN(event.id)){
		bootbox.dialog({
			message: "Booking options",
			buttons: {
				success: {
					label: "Export event",
					className: "btn-success",
					callback: function() {
						window.location = '/schedule/export?bookingId=' + event.id
					}
				}
			}
		});
	}
}
</script>
<?php
/** @var $adviser Adviser */
$this->widget('ext.EFullCalendar.EFullCalendar', array(
	'themeCssFile' => 'cupertino/theme.css',
	'id' => 'bookingCalendar',
	'htmlOptions' => array(
		'style' => 'width:80%',
	),
	// FullCalendar's options.
	// Documentation available at
	// http://arshaw.com/fullcalendar/docs/
	'options' => array(
		'header' => array(
			'left' => 'prev,next today',
			'center' => 'title',
			'right' => 'agendaWeek,agendaDay'
		),
		'defaultView' => 'agendaWeek',
		'firstDay' => 1,
		'lazyFetching' => true,
		'eventSources' => array(
			array( // checks weekly schedule
				'url' => CHtml::normalizeUrl(array('schedule/busy', 'adviserId' => $adviser->id)),
				'color' => 'yellow',
				'textColor' => 'red'
			),
			array(
				//checks booking
				'url' => CHtml::normalizeUrl(array('booking/check', 'adviserId' => $adviser->id)),
			)
		),
		'eventClick' => new CJavaScriptExpression("eventClickHandler"),
	)
));
?>
