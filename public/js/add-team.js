'use strict';

fields = [
	{
		'name': 'name',
		'status': 'empty',
		'rules': [
			{
				'message': 'Name length should be between 3 and 20 characters.',
				'type': 'size',
				'size-min': 3,
				'size-max': 20
			}
		]
	}
];