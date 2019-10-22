$(function(){

	$('.editPage').on('click',function(){

		$.ajax({
			url : 'get-page-detail',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			var src = base_url + 'uploads/banners/' + html.banner_image;

			$('#metatitle').val(html.page_meta_title);
			$('#pageId').val(html.page_id);
			$('#metakeywords').val(html.page_meta_keywords);
			$('#metadescription').html(html.page_meta_description);
			$('#pageName').html(html.page_name);
			$('#bannerImagePreview').attr('src',src);
		});
	});

	$('#seoForm').on('submit',function(e){
		e.preventDefault();

		if($('#pageId').val()){
			$.ajax({
				url : 'save-page-detail',
				type : 'post',
				data : $(this).serialize(),
				dataType : 'json'
			})
			.done(function(html){

				if(html.msg == 'done'){

					toastr.success('Meta Details Updated successfully.', 'Done!', { "closeButton": true },'Progress Bar', { "progressBar": true });				
					
					var src = base_url + 'uploads/banners/assets/user/images/hero/bread-1.jpg';

					$('#metatitle').val('');
					$('#pageId').val('');
					$('#metakeywords').val('');
					$('#metadescription').html('');
					$('#pageName').html('');
					$('#bannerImagePreview').attr('src',src);

				}else if(html.msg == 'error'){
					toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			})
		}else{

			alert('Please Select a Page First');
		}
	});


	$("#bannerImage").on('change',function(){
	    readBannerImage(this);
	});
});

function readBannerImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#bannerImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}