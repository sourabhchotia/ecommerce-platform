$(function(){

	// $('#customfileCat').on('click',function(){
	// 	$('#categoryImage').click();
	// });

	$("#categoryImage").on('change',function(){
	    readCategoyImage(this);
	});

	$('#categoryForm').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#categoryForm')[0]);

		$.ajax({
			url : 'save-category',
			type : 'post',
			data : data,
			dataType : 'json',
			cache: false,
		    contentType: false,
		    processData: false,
		})
		.done(function(html){
			
			if(html.msg == 'Inserted'){

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
		})
	});


	$('#parentCat, #parentCatOne').on('change',function(){

		var id = $(this).val();

		$.ajax({
			url : base_url + 'admin/category/get-categories-ajax',
			type : 'post',
			data : { id : id},
			dataType : 'html',
		})
		.done(function(html){

			if(html != ''){

				$('#mainCat, #mainCatOne').html(html);

			}else{

				toastr.error('No Main Category Found.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});

	$('#mainCat, #mainCatOne').on('change',function(){

		var id = $(this).val();

		$.ajax({
			url : base_url + 'admin/category/get-categories-ajax',
			type : 'post',
			data : { id : id},
			dataType : 'html',
		})
		.done(function(html){

			if(html != ''){

				$('#subCat, #subCatOne').html(html);

			}else{

				toastr.error('No Sub Category Found.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});

	$('#subCat, #subCatOne').on('change',function(){

		var id = $(this).val();

		$.ajax({
			url : base_url + 'admin/category/get-categories-ajax',
			type : 'post',
			data : { id : id},
			dataType : 'html',
		})
		.done(function(html){

			if(html != ''){

				$('#innerCat, #innerCatOne').html(html);

			}else{

				toastr.error('No Inner Category Found.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});

	$('.disable').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}
		$.ajax({
			url : 'change-category-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'changed'){
				toastr.success('Category has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});

	$('.edit').on('click',function(){

		$.ajax({
			url : 'edit-category',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){
			if(html.msg == 'error'){
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				return false;
			}

			$('#categoryName').val(html.name);
			$('#categoryId').val(html.id);
			$('#parentCat option[value="'+html.parentId+'"]').prop("selected", true);
			$('#mainCat').html('<option selected="" value="'+html.mainID+'">'+html.mainName+'</option>');
			$('#subCat').html('<option selected="" value="'+html.subId+'">'+html.subName+'</option>');

			$('#meta_title').val(html.meta_title);
			$('#meta_keywords').val(html.meta_keywords);
			$('#meta_description').html(html.meta_description);

			var src = base_url + 'uploads/category/thumbs/'+html.filename+'-150x150.'+html.ext; 

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