$(function(){

	$('.payout').on('click', function(){

		var id = PagSeguroDirectPayment.getSenderHash();

		var name = $('input[name=name]').val();
		var cpf = $('input[name=cpf]').val().replace(/[^\d]+/g,'');
		var email = $('input[name=email]').val();
		var password = $('input[name=password]').val();
		var phone = $('input[name=phone]').val().replace(/[^\d]+/g,'');

		var areacode = $('input[name=areacode]').val().replace(/[^\d]+/g,'');
		var street = $('input[name=street]').val();
		var number = $('input[name=number]').val();
		var complement = $('input[name=complement]').val();
		var neighborhood = $('input[name=neighborhood]').val();
		var city = $('input[name=city]').val();
		var state = $('input[name=state]').val();

		var cardholder = $('input[name=cardholder]').val();
		var cardholder_cpf = $('input[name=cardholder_cpf]').val().replace(/[^\d]+/g,'');
		var card_number = $('input[name=card_number]').val().replace(/[^\d]+/g,'');
		var cvv = $('input[name=cvv]').val();
		var exp_month = $('select[name=exp_month]').val();
		var exp_year = $('select[name=exp_year]').val();

		var inst = $('select[name=inst]').val();

		if (card_number != '' && cvv != '' && exp_month != '' && exp_year != '') {

			PagSeguroDirectPayment.createCardToken({
				cardNumber:card_number,
				brand:window.cardBrand,
				cvv:cvv,
				expirationMonth:exp_month,
				expirationYear:exp_year,
				success:function(r) {
					window.cardToken = r.card.token;

					$.ajax({
						url:BASE_URL+'checkoutTransparent/checkout',
						type:'POST',
						data:{
							id:id,
							name:name,
							cpf:cpf,
							email:email,
							password:password,
							areacode:areacode,
							street:street,
							number:number,
							complement:complement,
							neighborhood:neighborhood,
							city:city,
							state:state,
							cardholder:cardholder,
							cardholder_cpf:cardholder_cpf,
							card_number:card_number,
							cvv:cvv,
							exp_month:exp_month,
							exp_year:exp_year,
							card_token:window.cardToken,
							inst:inst,
							phone:phone
						},
						dataType:'json',
						success:function(json) {
							if (json.error == true) {
								alert(json.msg);
							} else {
								window.location.href = BASE_URL+"checkoutTransparent/thankyou";
							}
						},
						error:function(r) {

						},
						complete:function(r){}
					});

				},
				error:function(r){
					alert('Erro!');
					console.log(r);
				},
				complete:function(r){}
			});
		}
	});

	$('input[name=card_number]').on('keyup', function(e){

		var card = $(this).val().replace(/[^\d]+/g,'');

		if($(this).val().length >= 7) {

			PagSeguroDirectPayment.getBrand({
				cardBin:card,
				success:function(r){
					window.cardBrand = r.brand.name;
					var cvvLimit = r.brand.cvvSize;
					$('input[name=cvv]').attr('maxlength', cvvLimit);

					PagSeguroDirectPayment.getInstallments({
						amount:$('input[name=total]').val(),
						brand:window.cardBrand,
						success:function(r){

							if(r.error == false) {

								var inst = r.installments[window.cardBrand];
								var html = '';

								for(var i in inst) {
									var optionValue = inst[i].quantity+';'+inst[i].installmentAmount+';';
									if (inst[i].interestFree == true) {
										optionValue += 'true';
									} else {
										optionValue += 'false';
									}
									html += '<option value="'+optionValue+'">'+inst[i].quantity+'x de R$ '+inst[i].installmentAmount+' = R$ '+inst[i].totalAmount+'</option>';
								}

								$('select[name=inst]').html(html);
							}
						},
						error:function(r){

						},
						complete:function(r){}
					});
				},
				error:function(r){

				},
				complete:function(r){}
			});
		}
	});
});