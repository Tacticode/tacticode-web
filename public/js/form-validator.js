'use strict';

var fields = [];

function getField(name) {

	for (var i in fields) {

		if (fields[i].name == name)
			return fields[i];
	}
	return false;
}

function updateField(field) {

	var selector = '#' + field.name + '-group';

	$(selector).removeClass('has-success has-error');
	$('#' + field.name + '-icon').removeClass('fa-check fa-close fa-spin fa-spinner');
	$('#' + field.name + '-error').text('');

	if (field.status == 'valid') {

		$(selector).addClass('has-success');
		$('#' + field.name + '-icon').addClass('fa-check');
	} else if (field.status == 'error') {

		$(selector).addClass('has-error');
		$('#' + field.name + '-error').text(field.error);
		$('#' + field.name + '-icon').addClass('fa-close');
	} else if (field.status == 'loading') {

		$('#' + field.name + '-icon').addClass('fa-spin fa-load fa-spinner');
	}
}

function setError(field, message) {

	field.status = 'error';
	field.error = message;	
}

function resetHttp(field) {

	if (field.xhr) {
		
		field.xhr.abort();
		field.xhr = null;
	}
	if (field.ajax) {

		clearTimeout(field.ajax);
		field.ajax = null;
	}
}

function callAjax(field, value, rule) {

	field.status = 'loading';

	field.ajax = setTimeout(function() {

		field.ajax = null;
		field.xhr = $.getJSON(rule.url + value, null, function(data) {

			field.xhr = null;
			if (data.exists == "true") {

				field.status = 'error';
				field.error = rule.message;
			} else
				field.status = 'valid';
			updateField(field);
		});
	}, 1000);
}

function checkField(e) {

	var value = $(this).val();
	var field = getField(e.data.fieldName);

	resetHttp(field);

	field.status = 'valid';

	if (value.length == 0)
		field.status = 'empty';

	var ruleID = 0;
	while (ruleID < field.rules.length && field.status == 'valid') {

		var rule = field.rules[ruleID];

		if (rule.type == 'size') {
			if (value.length < rule['size-min'] || value.length > rule['size-max'])
				setError(field, rule.message);
		} else if (rule.type == 'regex') {
			if (!(rule.regex.test(value)))
				setError(field, rule.message);
		} else if (rule.type == 'ajax') {
			callAjax(field, value, rule);
		}

		++ruleID;
	}

	updateField(field);
}

$(document).ready(function() {

	for (var i in fields) {

		var field = fields[i];
		if (field.status == undefined)
			field.status = 'empty';
		field.xhr = null;
		field.ajax = null;
		$('input#' + field.name).bind('keyup', {fieldName: field.name}, checkField);
		$('input#' + field.name).bind('change', {fieldName: field.name},checkField);
	}
})