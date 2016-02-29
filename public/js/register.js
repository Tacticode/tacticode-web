'use strict';

fields = [
	{
		'name': 'login',
		'status': 'empty',
		'rules': [
			{
				'message': lang.validation.user.login.size,
				'type': 'size',
				'size-min': 3,
				'size-max': 20
			},
			{
				'message': lang.validation.user.login.exists,
				'type': 'ajax',
				'url': '/checkloginexists/'
			}
		]
	},
	{
		'name': 'email',
		'status': 'empty',
		'rules': [
			{
				'message': lang.validation.user.email.format,
				'type': 'regex',
				'regex': /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i
			},
			{
				'message': lang.validation.user.email.exists,
				'type': 'ajax',
				'url': '/checkemailexists/'
			}
		]
	},
	{
		'name': 'password',
		'status': 'empty',
		'rules': [
			{
				'message': lang.validation.user.password.size,
				'type': 'size',
				'size-min': 3,
				'size-max': 20
			}
		]
	},
];