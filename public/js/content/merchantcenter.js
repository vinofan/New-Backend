$('#active_promo_cnt').slider({
	id: 'active_promo_cnt',
	step: 1,
	min: 0,
	max: 20,
	value: [0,4],
	tooltip: 'always',
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});