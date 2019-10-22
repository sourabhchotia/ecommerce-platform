$(function(){

	$("#logo").on('change',function(){
	    readLogoImage(this);
	});

	$("#favicon").on('change',function(){
	    readFaviconImage(this);
	});


	$('#generalSettings').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#generalSettings')[0]);

		$.ajax({
			url : 'save-settings',
			type : 'post',
			data : data,
			dataType : 'json',
			processData : false,
			cache: false,
		    contentType: false,
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Site Setting has been Saved.', 'Weldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('#styleSetting').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#styleSetting')[0]);

		$.ajax({
			url : 'save-settings',
			type : 'post',
			data : data,
			dataType : 'json',
			processData : false,
			cache: false,
		    contentType: false,
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Site Setting has been Saved.', 'Weldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('#socialSettings').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#socialSettings')[0]);

		$.ajax({
			url : 'save-settings',
			type : 'post',
			data : data,
			dataType : 'json',
			processData : false,
			cache: false,
		    contentType: false,
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Site Setting has been Saved.', 'Weldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('#shopSettings').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#shopSettings')[0]);

		$.ajax({
			url : 'save-settings',
			type : 'post',
			data : data,
			dataType : 'json',
			processData : false,
			cache: false,
		    contentType: false,
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Site Setting has been Saved.', 'Weldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else if(html.msg == 'error'){
				toastr.error('Technical Error, Please try Again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				console.log(html);

				toastr.error('Undefined error, please check console for details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});
});


function readLogoImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#logoPreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readFaviconImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#faviconPreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}