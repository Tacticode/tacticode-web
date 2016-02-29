'use strict';

fields = [
	{
		'name': 'name',
		'status': 'empty',
		'rules': [
			{
				'message': lang.validation.addTeam.name.size,
				'type': 'size',
				'size-min': 3,
				'size-max': 20
			}
		]
	}
];