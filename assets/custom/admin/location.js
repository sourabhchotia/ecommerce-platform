$(function(){

	$('#countryForm').on('submit',function(e){

		e.preventDefault();

		$.ajax({
			url : 'add-country',
			type : 'post',
			data : $(this).serialize(),
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'updated'){

				toastr.success('Country has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'done'){

				toastr.success('Country has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('Country Already Added.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else if(html.msg == 'error'){

				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}
		});
	});

	$('.disableCountry').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'update-country',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){

				toastr.success('Country has been '+ message+'.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.editCountry').on('click',function(){

		$.ajax({
			url : 'edit-country',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			$('#countryName').val(html.name);
			$('#countryId').val(html.id);
			$('#countryShortName').val(html.short);
		})
	});


	/*
			
			State Related Javascript functions

			Author : Sourabh Chotia

	*/

	$('#stateForm').on('submit',function(e){

		e.preventDefault();

		$.ajax({
			url : 'add-state',
			type : 'post',
			data : $(this).serialize(),
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'updated'){

				toastr.success('State has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'done'){

				toastr.success('State has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('State Already Added.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else if(html.msg == 'error'){

				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}
		});
	});

	$('.disableState').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'update-state',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){

				toastr.success('State has been '+ message+'.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.editState').on('click',function(){

		$.ajax({
			url : 'edit-state',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			$('#stateName').val(html.name);
			$('#stateId').val(html.id);
			$('#stateShortName').val(html.short);
			$('#stateCountry option[value="'+html.country+'"]').prop("selected", true);
		})
	});


	/*
		Universal Functions 

		Author : Sourabh Chotia

	*/

	$('#stateCountry, #stateCountry1').on('change',function(){

		$.ajax({
			url : base_url + 'admin/location/get-state-from-country',
			type : 'post',
			data : { id : $(this).val()},
			dataType : 'html',
		})
		.done(function(html){
			$('#cityState, #cityState1').html(html);
		});
	});

	$('#cityState, #cityState1').on('change',function(){

		$.ajax({
			url : base_url + 'admin/location/get-city-from-state',
			type : 'post',
			data : { id : $(this).val()},
			dataType : 'html',
		})
		.done(function(html){
			$('#zipCity, #zipCity1').html(html);
		});
	});


	/*
			
			City Related Javascript functions

			Author : Sourabh Chotia

	*/

	$('#cityForm').on('submit',function(e){

		e.preventDefault();

		$.ajax({
			url : 'add-city',
			type : 'post',
			data : $(this).serialize(),
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'updated'){

				toastr.success('City has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'done'){

				toastr.success('City has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('City Already Added.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else if(html.msg == 'error'){

				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}
		});
	});

	$('.disableCity').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'update-city',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){

				toastr.success('City has been '+ message+'.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.editCity').on('click',function(){

		$.ajax({
			url : 'edit-city',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			$('#cityName').val(html.city_name);
			$('#cityId').val(html.id);
			$('#cityShortName').val(html.short);
			$('#stateCountry option[value="'+html.country+'"]').prop("selected", true);
			$('#cityState').html('<option selected="" value="'+html.state+'">'+html.statename+'</option>');
		})
	});


	/*
			
			City Related Javascript functions

			Author : Sourabh Chotia

	*/

	$('#zipcodeForm').on('submit',function(e){

		e.preventDefault();

		$.ajax({
			url : 'add-zipcode',
			type : 'post',
			data : $(this).serialize(),
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'updated'){

				toastr.success('Zipcode has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'done'){

				toastr.success('Zipcode has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('Zipcode Already Added.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else if(html.msg == 'error'){

				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				

			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}
		});
	});

	$('.disableZipcode').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'update-zipcode',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){

				toastr.success('Zipcode has been '+ message+'.', 'Opps', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.editZipcode').on('click',function(){

		$.ajax({
			url : 'edit-zipcode',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			$('#zipcode').val(html.code);
			$('#zipcodeId').val(html.id);
			$('#stateCountry option[value="'+html.country+'"]').prop("selected", true);
			$('#cityState').html('<option selected="" value="'+html.stateid+'">'+html.statename+'</option>');
			$('#zipCity').html('<option selected="" value="'+html.cityid+'">'+html.cityname+'</option>');
		})
	});


});