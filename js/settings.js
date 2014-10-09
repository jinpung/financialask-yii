$(document).ready(function() {
	$(document).on('click', '.settings-options-list .settings-option.closed, .settings-item.closed .settings-header', function(e) {
		if ($(this).hasClass('settings-header')) {
			$(this).closest('.settings-item').removeClass('closed').addClass('open');
		} else {
			$(this).removeClass('closed').addClass('open');
		}
		if ($(this).find('.down-arrow').length > 0) {
			$(this).find('.down-arrow').removeClass('down-arrow').addClass('up-arrow');
		}

		//if email form
		if ($(this).hasClass('your-email')) {
			$(this).find('input.email').val($(this).find('.user-email').text()).focus();
			$(this).find('input.password').val('');
		}
		//if password form
		if ($(this).hasClass('your-password')) {
			$(this).find('input[type=password]').val('');
		}
	});

	$(document).on('click', '.settings-option.open .btn2.cancel, .settings-option.open .up-arrow, .settings-option.open .content-wrap, .settings-item.open .settings-header', function(e) {
		if ($(this).hasClass('settings-header')) {
			$(this).closest('.settings-item').removeClass('open').addClass('closed');
			$(this).find('.up-arrow').removeClass('up-arrow').addClass('down-arrow');
		} else {
			$(this).closest('.settings-option').removeClass('open').addClass('closed');
			if ($(this).hasClass('up-arrow')) {
				$(this).removeClass('up-arrow').addClass('down-arrow');
			}
		}
	});

	$(document).on('click', '.settings-item.notification .on, .settings-item.notification .off', function() {
		if ($(this).hasClass('on')) {
			$(this).removeClass('on').addClass('off');
			$(this).find('.circle-active').removeClass('circle-active').addClass('circle');
		} else {
			$(this).removeClass('off').addClass('on');
			$(this).find('.circle').removeClass('circle').addClass('circle-active');
		}
	});

	$(document).on('click', '.deactivate-trigger', function(e) {
		$('.deactivate-content').show();
	});

	$(document).on('click', '.deactivate-content .cancel', function(e) {
		$('.deactivate-content').hide();
	});

	initEmailForm();

	initPasswordForm();

	initRateForm();

	initCallsForm();
});

function initEmailForm() {
	var wrapper = $('.settings-option.your-email');
	//enter key binding
	wrapper.find('input.email, input.password').keypress(function(e) {
		if (e.keyCode == 13) {
			if ($(this).hasClass('email')) {
				wrapper.find('input.password').focus();
			} else {
				wrapper.find('.save').click();
			}
		}
	});
	//clicking on save button
	var _saving = false;
	wrapper.find('.save').click(function(e) {
		if (_saving)
			return;
		wrapper.find('.error').hide().html('');

		wrapper.find('input.email').val($.trim(wrapper.find('input.email').val()));
		if (wrapper.find('input.email').val() == '') {
			wrapper.find('input.email').focus();
			return;
		}
		if (wrapper.find('input.password').val() == '') {
			wrapper.find('input.password').focus();
			return;
		}
		_saving = true;
		wrapper.find('input.email, input.password').attr('disabled', 'disabled');
		$.ajax({
			url: 'changeemail',
			type: 'post',
			data: {email: wrapper.find('input.email').val(), password: wrapper.find('input.password').val()},
			dataType: 'text',
			success: function(response) {
				if (response == 'TRUE') {
					wrapper.find('.user-email').text(wrapper.find('input.email').val());
					wrapper.find('.cancel').click();
				} else {
					wrapper.find('.error').html(response).show();
				}
			},
			complete: function() {
				_saving = false;
				wrapper.find('input.email, input.password').removeAttr('disabled');
			}
		});
	});
}

function initPasswordForm(){
	var wrapper = $('.settings-option.your-password');
	//enter key binding
	wrapper.find('input[type=password]').keypress(function(e) {
		if (e.keyCode == 13) {
			if ($(this).hasClass('current_password')) {
				wrapper.find('input.password').focus();
			}else if ($(this).hasClass('password')) {
				wrapper.find('input.password_confirmation').focus();
			} else {
				wrapper.find('.save').click();
			}
		}
	});

	//clicking on save button
	var _saving = false;
	wrapper.find('.save').click(function(e) {
		if (_saving)
			return;
		wrapper.find('.error').hide().html('');

		if (wrapper.find('input.current_password').val() == '') {
			wrapper.find('input.current_password').focus();
			return;
		}
		if (wrapper.find('input.password').val() == '') {
			wrapper.find('input.password').focus();
			return;
		}
		if (wrapper.find('input.password_confirmation').val() == '') {
			wrapper.find('input.password_confirmation').focus();
			return;
		}
		if(wrapper.find('input.password').val() !== wrapper.find('input.password_confirmation').val()){
			wrapper.find('.error').html('Confirm password doesn\'t match with new password.').show();
			wrapper.find('input.password_confirmation').focus();
			return;
		}
		wrapper.find('input[type=password]').attr('disabled', 'disabled');
		_saving = true;
		$.ajax({
			url: 'changepwd',
			type: 'post',
			data: {current_password: wrapper.find('input.current_password').val(), password: wrapper.find('input.password').val()},
			dataType: 'text',
			success: function(response) {
				if (response == 'TRUE') {
					wrapper.find('.cancel').click();
				} else {
					wrapper.find('.error').html(response).show();
				}
			},
			complete: function() {
				_saving = false;
				wrapper.find('input[type=password]').removeAttr('disabled');
			}
		});
	});
}
function initRateForm(){
	var wrapper = $('.settings-option.your-rate');
	wrapper.find('input[type=number]').on('keypress focusout',function(e){
		var $this = $(this);
		if(e.type=='keypress'&& e.keyCode!=13)
			return e.default;
		var rate = parseFloat($this.val());
		if(rate){
			$.ajax({
				type:'get',
				url:'/profile/rate',
				data:{value:rate},
				dataType:'json',
				success:function(response)
				{
					if(response.status)
					{
						$('#user-rate').html(parseFloat(response.value).toFixed(2));
						$this.val(parseFloat(response.value).toFixed(2));
						wrapper.removeClass('open').addClass('closed');
						wrapper.find('.error').hide();
					} else {
						wrapper.find('.error').show().html(response.value);
					}
				}
			});
		} else $(this).val(0);
	})
}
function initCallsForm()
{
	var wrapper =  $('.settings-option.direct-calls ');
	wrapper.find('select').on('change',function(e){
		var $this = $(this);
		$.ajax({
			url:'/profile/calls',
			data:{value:$this.val()},
			success:function(response)
			{
				$('#direct-calls-status').html(response);
				wrapper.removeClass('open').addClass('closed');
			}
		})

	});
}


