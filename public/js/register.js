'use strict';

fields = [
	{
		'name': 'login',
		'status': 'empty',
		'rules': [
			{
				'message': 'Login length should be between 3 and 20 characters.',
				'type': 'size',
				'size-min': 3,
				'size-max': 20
			},
			{
				'message': 'The login has already been taken.',
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
				'message': 'Please enter a valid email.',
				'type': 'regex',
				'regex': /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i
			},
			{
				'message': 'The email has already been taken.',
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
				'message': 'Password length should be between 3 and 50 characters.',
				'type': 'size',
				'size-min': 3,
				'size-max': 20
			}
		]
	},
];