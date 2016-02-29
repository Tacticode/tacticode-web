'use strict';

var teams = {

	charactersList: [],
	charactersListLength: 0,

	canAddCharacter: function() {

		var length = $('.characters .form-group').length;
		if (length >= 5) {

			$.growl({message: lang.teams.maxCharacters(5), style: "warning", title: ""});
			return false;
		}
		if (this.charactersListLength == 0) {

			$.growl({message: lang.teams.noCharacters, style: "warning", title: ""});
			return false;
		}
		if (length >= this.charactersListLength) {

			$.growl({message: lang.teams.notEnoughCharacters(this.charactersListLength), style: "warning", title: ""});
			return false;
		}
		return true;
	},

	getMaxCharacterId: function() {

		return $('.characters .form-group').length + 1;
	},

	addCharacter: function() {

		if (!this.canAddCharacter())
			return;
		
		var id = this.getMaxCharacterId();
		
		var formGroup = ($('<div>', {
			'class': 'form-group',
			'rel': id
		})).appendTo($('.characters'));
		
		formGroup.append($('<label>', {
			'for': 'character' + id,
			'text': lang.teams.character + ' ' + id
		})).append(' - ').append($('<a>', {
			'onclick': 'teams.removeCharacter(' + id + ')',
			'class': 'clickable red',
			'text': lang.teams.removeCharacter
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

		var maxIndex = $('.characters .form-group').length;
		$('.characters .form-group').each(function(index) {

			if (index >= (id - 1) && index < maxIndex - 1) {

				var value = $('.characters .form-group[rel=' + (index + 2) + '] select').val();
				$('.characters .form-group[rel=' + (index + 1) + '] select').val(value);
			}
		});
		$('.characters .form-group[rel=' + (maxIndex) + ']').remove();
	},

	loadCharactersList: function() {

		this.charactersList = $.parseJSON($('#characters-list').text());
		$('#characters-list').remove();
		this.charactersListLength = 0;
		for (var i in this.charactersList)
			this.charactersListLength++;
	},

	checkSubmit: function(e) {

		var ids = [];
		$('.characters .form-group select').each(function(index) {

			var value = $(this).val();
			if (value > 0 && ids.indexOf(value) != -1) {

				$.growl({message: lang.teams.cantDuplicateCharacter, style: "error", title: ""});
				e.preventDefault();
				return false;
			}
			if (value > 0)
				ids.push(value);
		});
	}
}

$(document).ready(function() {

    teams.loadCharactersList();
});