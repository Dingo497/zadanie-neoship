(function($) {

var table 			= $('table'),
		newRow 			= table.find('.new-row'),
		descriptions= newRow.siblings('.descriptions'),
		rowId 			= newRow.attr('id'),
		id 					= descriptions.attr('id');

descriptions.hide();
newRow.css('cursor', 'pointer');

newRow.on('click', function(){

	$(this).addClass('bg-success bg-gradient text-white')
				 .next()
				 .fadeToggle('fast')
				 .addClass('bg-success bg-gradient text-white')
				 .siblings('.descriptions')
				 .removeClass('bg-success bg-gradient text-white')
				 .fadeOut('fast')
				 .prev()
				 .removeClass('bg-success bg-gradient text-white');

});



})(jQuery);