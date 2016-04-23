$(function() {

	$('#notifications').click(function() {

		$.ajax('/notifications/see');
		$('#notifications .badge').remove();
	});
});