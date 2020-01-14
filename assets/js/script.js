$(function(){

	$('#cpf').mask('000.000.000-00', {reverse: true});
	$('#cardholder_cpf').mask('000.000.000-00', {reverse: true});
	$('#areacode').mask('00000-000');
	$('#card_number').mask('0000.0000.0000.0000');

	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('#phone').mask(SPMaskBehavior, spOptions);

	$( "#slider-range" ).slider({
		range: true,
		min: minslider,
		max: maxslider,
		values: [$('#slider0').val(), $('#slider1').val()],
		slide: function( event, ui ) {
			$( "#amount" ).val( "R$ " + ui.values[ 0 ] + " - R$ " + ui.values[ 1 ] );
		},
		change: function( event, ui ) {
			$('#slider'+ui.handleIndex).val(ui.value);
			$('.filterarea form').submit();
		}
	});

	$( "#amount" ).val( "R$ " + $( "#slider-range" ).slider( "values", 0 ) + " - R$ " + $( "#slider-range" ).slider( "values", 1 ) );

	$('.filterarea').find('input').on('change', function(){
		$('.filterarea form').submit();
	});

	$('.photo_item').on('click', function(){
		var url = $(this).find('img').attr('src');
		$('.mainphoto').find('img').attr('src', url);
	});

	$('.cart_input_qt').on('change', function(){
		var item = $(this).attr('data-id');
		var cart_qt = $(this).val();

		$.ajax({
			url:BASE_URL+'cart/changeQuant',
			type:'POST',
			data:{item:item, cart_qt:cart_qt},
			dataType:'json',
			success:function(json) {
				window.location.reload();
			}
		});
	});

});