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
		]
	}
];