var flashes = {

	error: function(message) {

		$.growl({message: message, style: "error", title: ""});	
	},
	warning: function(message) {

		$.growl({message: message, style: "warning", title: ""});		
	},
	notice: function(message) {

		$.growl({message: message, style: "notice", title: ""});	
	}
}

$(document).ready(function() {

	$('#flashes div').each(function(index) {

		var message = $(this).text();
		if ($(this).hasClass('notice'))
			flashes.notice(message);
		else if ($(this).hasClass('warning'))
			flashes.warning(message);
		else
			flashes.error(message);
	});
	$('#flashes').remove();
});