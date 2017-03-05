// @codekit-prepend '../bower_components/webfontloader/webfontloader.js'
// @codekit-prepend '../bower_components/jquery/dist/jquery.js'
// @codekit-prepend 'navigation.js'


/*--------------------------------------------------------------
# Wide Columns
--------------------------------------------------------------*/
var widecols = function() {
	var main_el = $("body");
	$(".acf-wide:not([data-stretch-type='standard'])").each(function() {
		var widecols = $(this);
		widecols.css({
			"margin-left": 0,
			"margin-right": 0,
			"padding-left": 0,
			"padding-right": 0
		});
		var i = widecols.offset().left - main_el.offset().left,
			n = main_el.outerWidth() - i - widecols.parent().outerWidth();
		widecols.css({
			"margin-left": -i,
			"margin-right": -n,
			"padding-left": "full" === widecols.data("stretch-type") ? i : '',
			"padding-right": "full" === widecols.data("stretch-type") ? n : ''
		});
	});
};
$(widecols);
$(window).resize(widecols);


$(document).ready(function() { });
