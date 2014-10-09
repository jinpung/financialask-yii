function initStripeWidget(config) {
	var handler = StripeCheckout.configure({
		key: config.publicKey,
		image: config.imageUrl,
		token: function (token) {
			$.ajax({
				async:false,
				type:'post',
				url:config.chargeUrl,
				data:{
					token:token.id,
					email:token.email,
					amount:$(config.inputSelector).val()
				},
				dataType:'json',
				success:function(response)
				{
					$('#info'+config.wId)
						.addClass(response.status ? 'alert-success':'alert-warning')
						.html(response.message);
					$(config.amountSelector).html(parseFloat(response.amount).toFixed(2))
				}
			});
			// Use the token to create the charge with a server-side script.
			// You can access the token ID with `token.id`
		}
	});
	$('#button' + config.wId).on('click', function (e) {
		handler.open({
			email: config.email,
			name: config.name,
			description: config.description,
			amount: $(config.inputSelector).val() * 100
		});
		e.preventDefault();
	});
}