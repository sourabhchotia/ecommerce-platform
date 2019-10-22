$(function(){

	$('#sliderImage').on('change',function(){
		readSliderImage(this);
	})
	$('#sliderForm').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#sliderForm')[0]);

		$.ajax({
			url : 'save-slider',
			type : 'post',
			data : data,
			dataType : 'json',
			cache: false,
		    contentType: false,
		    processData: false,
		})
		.done(function(html){
			
			if(html.msg == 'Inserted'){

				toastr.success('Slider has been created.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else if(html.msg == 'updated'){

				toastr.success('Slider has been Updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.editSlider').on('click',function(){

		$.ajax({
			url : 'edit-slider',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){
			if(html.msg == 'error'){
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				return false;
			}

			$('#sliderheading').val(html.slider_heading);
			$('#sliderId').val(html.slider_id);
			$('#sliderCaption').val(html.slider_caption);
			$('#sliderButtonText').val(html.slider_button_text);
			$('#sliderURL').html(html.slider_page_url);

			var src = base_url + 'uploads/sliders/'+ html.slider_image; 

			$('#sliderImagePreview').prop('src',src);
		});
	});

	$('.disableSlider').on('click',function(){
		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}
		$.ajax({
			url : 'change-slider-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'changed'){
				toastr.success('Slider has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	})
});


function readSliderImage(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#sliderImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}