<script type="application/javascript">
	function isOverlapping(event) {
		// "calendar" on line below should ref the element on which fc has been called
		var array = $('#bookingCalendar').fullCalendar('clientEvents');
		for (i in array) {
			if ((array[i].start.isBefore(event.end) || array[i].start.isSame(event.end) ) && event.start <= array[i].end) {
				return true;
			}
		}
		return false;
	}
	function isValidDuration(event) {
		return event.end.diff(event.start, 'minutes') <= 120;
	}
	function bookingForm(event) {
		$('#startTime').html(event.start.format('LLLL'));
		$('#endTime').html(event.end.format('LLLL'));
		var $form = $('#modalBookingForm');
		$form.find('input[name="Booking[start]"]').val(event.start.format('YYYY-MM-DD HH:mm:ss'));
		$form.find('input[name="Booking[end]"]').val(event.end.format('YYYY-MM-DD HH:mm:ss'));
		$form.modal();
	}
	function checkCredit(duration, adviserId) {
		var result;
		$.ajax({
			dataType: 'json',
			url: '/booking/checkPrice',
			async: false,
			data: {adviserId: adviserId, duration: duration},
			success: function (data) {
				result = data;
			}
		});
		return result;
	}
	function selectHandler(start, end, adviserId) {

		var eventData;
		$calendar = $('#bookingCalendar');
		bootbox.confirm("Are you sure to add booking?", function (result) {
				if (result) {
					eventData = {
						title: 'Booking',
						start: start,
						end: end
					};
					if (isOverlapping(eventData)) {
						bootbox.dialog({
							message: 'Wrong time',
							title: 'Please, select another time'
						});
						$calendar.fullCalendar('unselect');
						return true;
					}
					if (!isValidDuration(eventData)) {
						bootbox.dialog({
							message: 'Wrong duration',
							title: 'Max duration is 2 hours'
						});
						$calendar.fullCalendar('unselect');
						return true;
					}
					if (!checkCredit(eventData.end.diff(eventData.start, 'minutes') / 60, adviserId)) {
						bootbox.dialog({
							message: 'Insufficient funds for booking',
							title: 'Please add credit'
						});
						$calendar.fullCalendar('unselect');
						return true;
					}
					bookingForm(eventData, adviserId);
					//$calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
				} else {
					$calendar.fullCalendar('unselect');
				}
			}
		);


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
		'selectable' => array(
			'agendaDay' => true,
			'default' => false
		),
		'defaultView' => 'agendaWeek',
		'selectHelper' => true,
		'firstDay' => 1,
		//disable previous date
		'viewRender' => new CJavaScriptExpression("
		function(view){
			if (view.start < new moment()){
				$('#bookingCalendar').fullCalendar('gotoDate', new moment());
			}
		}
		"),
		'select' => new CJavaScriptExpression("
		function(start, end) {
				selectHandler(start, end,{$adviser->id});
			}
		"),
		'lazyFetching' => true,
		'eventSources' => array(
			array( // checks weekly schedule
				'url' => CHtml::normalizeUrl(array('schedule/busy', 'adviserId' => $adviser->id)),
				'color' => 'yellow',
				'textColor' => 'red'
			),
			array(
				//checks booking
				'url' => CHtml::normalizeUrl(array('check', 'adviserId' => $adviser->id)),
			)
		)
		//'events'=>$schedule,

	)
));
$this->renderPartial('_bookingForm', compact('adviser', 'bookingForm'));
?>
