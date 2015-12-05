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

var loginAjax = null;
var loginXhr = null;

function checkLoginTaken(field, login) {

	field.status = 'loading';
	updateField(field);

	loginAjax = setTimeout(function() {

		loginAjax = null;
		loginXhr = $.getJSON('/checkloginexists/' + login, null, function(data) {

			loginXhr = null;
			if (data.exists == "true") {

				field.status = 'error';
				field.error = 'The login has already been taken.';
			} else
				field.status = 'valid';
			updateField(field);
		});
	}, 1000);
}

function checkLogin() {

	if (loginXhr) {
		
		loginXhr.abort();
		loginXhr = null;
	}
	if (loginAjax) {

		clearTimeout(loginAjax);
		loginAjax = null;
	}

	var login = $(this).val();
	var field = getField('login');

	field.status = 'valid';

	if (login.length == 0)
		field.status = 'empty';
	else if (login.length < 3 || login.length > 20) {

		field.status = 'error';
		field.error = 'Login length should be between 3 and 20 characters.';
	} else
		checkLoginTaken(field, login);

	updateField(field);
}

var emailAjax = null;
var emailXhr = null;

function checkEmailTaken(field, email) {

	field.status = 'loading';
	updateField(field);

	loginAjax = setTimeout(function() {

		loginAjax = null;
		loginXhr = $.getJSON('/checkemailexists/' + email, null, function(data) {

			loginXhr = null;
			if (data.exists == "true") {

				field.status = 'error';
				field.error = 'The email has already been taken.';
			} else
				field.status = 'valid';
			updateField(field);
		});
	}, 1000);
}

function checkEmail() {

	if (emailXhr) {
		
		emailXhr.abort();
		emailXhr = null;
	}
	if (emailAjax) {

		clearTimeout(emailAjax);
		emailAjax = null;
	}

	var email = $(this).val();
	var field = getField('email');

	field.status = 'valid';

	if (email.length == 0)
		field.status = 'empty';
	else if (!(/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i.test(email))) {

		field.status = 'error';
		field.error = 'Please enter a valid email.';
	} else
		checkEmailTaken(field, email);

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