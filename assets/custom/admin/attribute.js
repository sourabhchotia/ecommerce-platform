$(function(){

	// Attribute Functions

	// Add or Update Function
	$('#attributeForm').on('submit',function(e){

		e.preventDefault();

		$.ajax({

			url : 'save-attribute',
			type : 'post',
			data : $(this).serialize(),
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'inserted'){

				toastr.success('Attribute has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'updated'){

				toastr.success('Attribute has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('Attribute already exists in database.', 'OOPS!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	// Status Change Function
	$('.disable').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'change-attribute-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'updated'){
				toastr.success('Attribute has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});


	// Get Data and Populate the Form This data
	$('.edit').on('click',function(){

		$.ajax({
			url : 'get-attribute',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'success'){

				$('#attributeName').val(html.name);

				if(html.filter == '1'){
					$('#is_filter').prop('checked',true);
				}else{
					$('#is_filter').prop('checked',false);
				}

				if(html.variant == '1'){
					$('#is_variant').prop('checked',true);
				}else{
					$('#is_variant').prop('checked',false);
				}

				if(html.type == 'size'){
					$('#is_size').prop('checked',true);
				}else{
					$('#is_size').prop('checked',false);
				}

				if(html.type == 'color'){
					$('#is_color').prop('checked',true);
				}else{
					$('#is_color').prop('checked',false);
				}

				if(html.type == 'other'){
					$('#is_color').prop('checked',false);
					$('#is_size').prop('checked',false);
				}

				$('#attributeId').val(html.id);
			}
		});
	});


	// Attribute Option Functions

	// Change the Value Field Type According to the Option Type
	$('#opacity').minicolors({
        theme: 'bootstrap'
    });
	$('#optionType').on('change',function(){
		if($(this).val() == 'color'){
			$('#opacity').minicolors({
		        theme: 'bootstrap'
		    });
		}else{
			$('#opacity').minicolors('destroy');
		}
	});

	// Add or Update Attribute Options Function

	$('#attributeOptionForm').on('submit',function(e){

		e.preventDefault();

		$.ajax({
			url : 'save-option',
			type : 'post',
			data : $(this).serialize(),
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'inserted'){

				toastr.success('Attribute Option has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'updated'){

				toastr.success('Attribute Option has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('Attribute Option already exists in database.', 'OOPS!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.disableOption').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'change-option-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'updated'){
				toastr.success('Attribute Option has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});


	// Get Data and Populate the Form This data
	$('.editOption').on('click',function(){

		$.ajax({
			url : 'get-option',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'success'){

				$('#attributeOptionName').val(html.name);
				$('#attributeOptionId').val(html.id);
				$('#attributeOptionDisplayName').val(html.display);
				$('#attributeName option[value ="'+html.attribute+'"]').prop('selected',true);
				$('#optionType option[value ="'+html.type+'"]').prop('selected',true);
				$('#opacity').val(html.value);

				if(html.type == 'color'){
					$('#opacity').minicolors({
				        theme: 'bootstrap'
				    });
				}else{
					$('#opacity').minicolors('destroy');
				}
			}
		});
	});

	$('#DOM_pos').DataTable({
	    "bSort" : false,
	});
	
	$('#selectAll').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#selectAll').prop('checked',true);
        }else{
            $('#selectAll').prop('checked',false);
        }
    });

    $('#attribute').on('change',function(){

    	$.ajax({
    		url : 'get-attribute-options',
    		type : 'post',
    		data : { id : $(this).val()},
    		dataType : 'html'
    	})
    	.done(function(html){

    		$('#resultBody').html(html);
    	})

    });

    $('#assignOption').on('submit',function(e){

    	e.preventDefault();

    	$.ajax({
    		url : 'save-options-to-attributes',
    		type : 'post',
    		data : $(this).serialize(),
    		dataType : 'json'
    	})
    	.done(function(html){

    		if(html.msg == 'true'){
    			toastr.success('Attribute Option has been Assigned Successfully', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);

    		}else{
    			toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
    		}
    	});
    });
});