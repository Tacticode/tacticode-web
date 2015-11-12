'use strict';

var fields = [
	{
		'name': 'login',
		'status': 'empty'
	},
	{
		'name': 'email',
		'status': 'empty'
	},
	{
		'name': 'password',
		'status': 'empty'
	},
];

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
	$('#' + field.name + '-icon').removeClass('fa-check fa-close');
	$('#' + field.name + '-error').text('');

	if (field.status == 'valid') {

		$(selector).addClass('has-success');
		$('#' + field.name + '-icon').addClass('fa-check');
	}
	else if (field.status == 'error') {

		$(selector).addClass('has-error');
		$('#' + field.name + '-error').text(field.error);
		$('#' + field.name + '-icon').addClass('fa-close');
	}
}

function checkLogin() {

	var login = $(this).val();
	var field = getField('login');

	field.status = 'valid';

	if (login.length == 0)
		field.status = 'empty';
	else if (login.length < 3 || login.length > 20) {

		field.status = 'error';
		field.error = 'Login length should be between 3 and 20 characters.';
	}

	updateField(field);
}

function checkEmail() {

	var email = $(this).val();
	var field = getField('email');

	field.status = 'valid';

	if (email.length == 0)
		field.status = 'empty';
	else if (!(/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i.test(email))) {

		field.status = 'error';
		field.error = 'Please enter a valid email.';
	}

	updateField(field);
}

function checkPassword() {

	var password = $(this).val();
	var field = getField('password');

	field.status = 'valid';

	if (password.length == 0)
		field.status = 'empty';
	else if (password.length < 3 || password.length > 50) {

		field.status = 'error';
		field.error = 'Password length should be between 3 and 50 characters.';
	}

	updateField(field);
}

$(document).ready(function() {

	$('input#login').keyup(checkLogin);
	$('input#login').change(checkLogin);

	$('input#email').keyup(checkEmail);
	$('input#email').change(checkEmail);

	$('input#password').keyup(checkPassword);
	$('input#password').change(checkPassword);
})