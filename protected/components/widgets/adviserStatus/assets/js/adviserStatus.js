function adviserStatus(options) {
	setInterval(function () {
		$.ajax({
			type: 'post',
			url: options.checkUrl,
			dataType: 'json'
		}).done(function (data) {
			if(data.status){
				$.ajax({
					type:'post',
					url:options.callerInfoUrl,
					data:{callId:data.callId}
				}).done(function(data){
					$(options.selector + ' .modal-body').html(data);
					$(options.selector).modal();
				});

				$(options.selector + ' button.accept').click(function(){
					window.location = data.link;
				});
				$(options.selector).on('hidden.bs.modal', function () {
					$.ajax({
						type: 'post',
						data:{status:1,callId:data.callId},
						url:options.statusUrl
					})
				})
				}
		})
	}, options.checkInterval);

}