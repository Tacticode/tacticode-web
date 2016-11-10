var tactichat = {

	lastMessage: 0,
	interval: null,
	open: false,

	htmlEncode: function(value){
	  return $('<div/>').text(value).html();
	},

	show: function() {

		tactichat.open = true;
		tactichat.launchInterval();
		$('#tactichat-button').animate({'right': -50});
		$('#tactichat').animate({'right': 0});
		$('nav').animate({'padding-right': 300});
		$('#tactichat-write input').focus();
	},

	hide: function() {

		$('#tactichat-button').animate({'right': 0});
		$('#tactichat').animate({'right': -300});
		$('nav').animate({'padding-right': 0});
		tactichat.stopInterval();
		tactichat.open = false;
	},

	newMessage: function(author, message) {

		$('<div>', {class: 'tactichat-message'})
		.append($('<span>', {class: 'tactichat-author', text: tactichat.htmlEncode(author)}))
		.append(tactichat.htmlEncode(message))
		.appendTo($('#tactichat-messages'));
	},

	write: function(event) {

		if (event.keyCode !== 13 || !tactichat.interval)
			return;

		var message = $('#tactichat-write input').val();
		$('#tactichat-write input').val('');

		tactichat.stopInterval();

		$.post('/tactichat/write/' + tactichat.lastMessage, {'message': message})
		.then(function(messages) {
			tactichat.treatMessageList(messages);
		}).fail(function() {
			tactichat.launchInterval();
		});
	},

	treatMessageList: function(messages) {

		messages.forEach(function(message) {
			tactichat.lastMessage = message.id;
			tactichat.newMessage(message.user.login, message.message);
		});
		tactichat.launchInterval();
	},

	launchInterval: function() {

		if (tactichat.interval === null && tactichat.open === true) {
			tactichat.interval = setInterval(function() {
				$.get('/tactichat/lastfrom/' + tactichat.lastMessage).then(tactichat.treatMessageList);
			}, 1500);
		}
	},

	stopInterval: function() {

		clearInterval(tactichat.interval);
		tactichat.interval = null;
	},

	init: function() {

		$('#tactichat-button').click(tactichat.show);
		$('#tactichat-close').click(tactichat.hide);
		$('#tactichat-write input').keypress(tactichat.write);

		$.get('/tactichat/lasts').then(tactichat.treatMessageList);
	}
};

$(function() {
	tactichat.init();
});