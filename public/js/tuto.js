var tuto = {
	init: function() {

		if ($('#showTuto').val()) {
			
			$('#showTuto').remove();
			$('#tuto-modal').modal();
		}
	}
}

$(function() {
	tuto.init();
});