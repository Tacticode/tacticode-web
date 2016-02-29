var lang = {
	
	'sure': 'Are you sure?',
	'validation': {
		'addTeam': {
			'name': {
				'size': 'Name length should be between 3 and 20 characters.'
			}
		},
		'user': {
			'login': {
				'size': 'Login length should be between 3 and 20 characters.',
				'exists': 'The login has already been taken.'
			},
			'email': {
				'format': 'Please enter a valid email.',
				'exists': 'The email has already been taken.'
			},
			'password': {
				'size': 'Password length should be between 3 and 50 characters.'
			}
		}
	},
	'powers': {
		'cantSell': 'You could not buy this node !',
		'cantBuy': 'You could not sell this node !',
	},
	'teams': {
		notEnoughCharacters: function(number) {return 'You only have ' + number + ' different characters.'},
		maxCharacters: function(max) {return 'You can\'t add more than ' + max + ' characters in a team.'},
		'noCharacters': 'You don\'t have any character...',
		'cantDuplicateCharacter': 'You can\'t duplicate a character !',
		'character': 'Character',
		'removeCharacter': 'Remove character'
	}
};