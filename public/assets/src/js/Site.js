var Site = {

	picker_options: {
		format: 'dd/mm/yyyy',
		todayBtn: "linked",
		todayHighlight: true
	},

	init: function() {
		Site.reusableModal();
		Site.setupDatepickers();
		Site.setupTabs();
	},

	setupTabs: function() {
		Site.tabsHistory();

		// push redirect url into modal form
		$('body').on('shown.bs.modal', '.modal', function (e) {
			var form = $(e.target).find('form');
			form.append("<input type='hidden' name='pm_redirect' value='"+window.location.href+"' />");
		});
	},

	tabsHistory: function() {	
		if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');

		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			if(history.pushState) {
				history.pushState(null, null, '#'+$(e.target).attr('href').substr(1));
			} else {
				location.hash = '#'+$(e.target).attr('href').substr(1);
			}
		});
	},

	reusableModal: function() {
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	},

	setupDatepickers: function() {
		Site.initDatepickers();
		$('body').on('shown.bs.modal', '.modal', function () {
			Site.initDatepickers();
		});
	},

	initDatepickers: function() {
		$('.input-daterange, .datepicker').datepicker(Site.picker_options);
	}
}

$(document).ready(Site.init);

$(document).ready(function() {
    

});