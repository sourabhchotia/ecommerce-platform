$(function(){

	$("#brandImage").on('change',function(){
	    readCategoyImage(this);
	});

	$('#brandForm').on('submit',function(e){
		e.preventDefault();

		var data = new FormData($('#brandForm')[0]);

		$.ajax({
			url : 'save-brands',
			type : 'post',
			data : data,
			dataType : 'json',
			cache : false,
			processData : false, 
			contentType : false
		})
		.done(function(html){
			if(html.msg == 'inserted'){

				toastr.success('Category has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'updated'){

				toastr.success('Category has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'already'){

				toastr.warning('Category already exists in database.', 'OOPS!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});

	});

	$('.disable').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}
		$.ajax({
			url : 'change-brand-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'changed'){
				toastr.success('Brand has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});

	$('.edit').on('click',function(){

		$.ajax({
			url : 'edit-brand',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			console.log(html);

			if(html.msg == 'error'){
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				return false;
			}

			$('#brandName').val(html.name);
			$('#brandId').val(html.id);

			var src = base_url + 'uploads/brands/thumbs/'+html.filename+'-150x50.'+html.ext; 

			$('#categoryImagePreview').prop('src',src);
		})
	})
});

function readCategoyImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#categoryImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}