var tactichat = {

	lastMessage: 0,
	token: '',
	interval: null,

	show: function() {

		$('#tactichat-button').animate({'right': -50});
		$('#tactichat').animate({'right': 0});
		$('nav').animate({'padding-right': 300});
		$('#tactichat-write input').focus();
	},

	hide: function() {

		$('#tactichat-button').animate({'right': 0});
		$('#tactichat').animate({'right': -300});
		$('nav').animate({'padding-right': 0});
	},

	newMessage: function(author, message) {

		$('<div>', {class: 'tactichat-message'})
		.append($('<span>', {class: 'tactichat-author', text: author}))
		.append(message)
		.appendTo($('#tactichat-messages'));
	},

	write: function(event) {

		if (event.keyCode !== 13 || !tactichat.interval)
			return;

		console.log(tactichat.interval);

		var message = $('#tactichat-write input').val();
		$('#tactichat-write input').val('');

		clearInterval(tactichat.interval);
		tactichat.interval = null;

		$.ajax({
			type: 'post',
			url: '/tactichat/write/' + tactichat.lastMessage,
			headers: {'X-XSRF-TOKEN' : token},
			data: {
				'message': message
			}
		}).then(function(messages) {
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

		if (tactichat.interval === null) {
			tactichat.interval = setInterval(function() {
				$.get('/tactichat/lastfrom/' + tactichat.lastMessage).then(tactichat.treatMessageList);
			}, 1500);
		}
	},

	init: function() {

		$('#tactichat-button').click(tactichat.show);
		$('#tactichat-close').click(tactichat.hide);
		$('#tactichat-write input').keypress(tactichat.write);

		$.get('/tactichat/lasts').then(tactichat.treatMessageList);

		tactichat.token = $('#token').val();
	}
};

$(function() {
	tactichat.init();
});