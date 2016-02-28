'use strict';

var teams = {

	characters: [],
	charactersList: [],

	canAddCharacter: function() {

		return (this.characters.length < 5 && this.characters.length < this.charactersList.length)
	},

	getMaxCharacterId: function() {

		var maxId = 0;
		for (var i in this.characters) {

			if (i > maxId)
				maxId = i;
		}
		return parseInt(maxId) + 1;
	},

	addCharacter: function() {

		if (!this.canAddCharacter())
			return;
		
		var id = this.getMaxCharacterId();
		
		this.characters[id] = 0;
		
		var formGroup = ($('<div>', {
			'class': 'form-group',
			'rel': id
		})).appendTo($('.characters'));
		
		formGroup.append($('<label>', {
			'for': 'character' + id,
			'text': 'Character ' + id
		})).append(' - ').append($('<a>', {
			'onclick': 'teams.removeCharacter(' + id + ')',
			'class': 'clickable red',
			'text': 'Remove character'
		}));

		var select = $('<select>', {
			'class': 'form-control',
			'id': 'character' + id,
			'name': 'characters[' + id + ']'
		}).appendTo(formGroup);

		for (var i in this.charactersList) {

			select.append($('<option>', {
				'value': i,
				'text': this.charactersList[i]
			}));
		}
	},

	removeCharacter: function(id) {

		$('.characters .form-group[rel=' + id + ']').remove();
		this.characters.splice(id, 1);
	},

	loadCharactersList: function() {

		this.charactersList = $.parseJSON($('#characters-list').text());
		$('#characters-list').remove();
	}
}

$(document).ready(function() {

    teams.loadCharactersList();
});