$(function(){

	$("#categoryImage").on('change',function(){
	    readCategoyImage(this);
	});


	$("#blogTags").select2({
	    tags: true,
	    tokenSeparators: [',', ' ']
	});



	$('#categoryForm').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#categoryForm')[0]);

		$.ajax({
			url : 'save-blogs-category',
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

	$('.disable').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}
		$.ajax({
			url : 'change-blogs-category-status',
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
			url : 'edit-blogs-category',
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
			var src = base_url + 'uploads/blogs/category/thumbs/'+html.filename+'-150x150.'+html.ext; 

			$('#categoryImagePreview').prop('src',src);
		});
	});

	var dataTable =$('#empTable').DataTable({
      	'processing': true,
      	'serverSide': true,
      	"bSort" : false,
      	'serverMethod': 'post',
      	'ajax': {
          	'url': 'get-blogs-listing',
          	type : 'post',
          	data : function(data){
          		var fromDate =$('#fromDate').val(); 
          		var ToDate =$('#ToDate').val();
          		var art_id =$('#category_id').val();
          		data.from = fromDate;
          		data.to = ToDate;
          		data.category_id = art_id;
          	},
          	error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            },
      },
      'columns': [
      		{data : 'blog_image'},
      	 	{data : 'blog_title'},
         	{ data: 'category' },
         	{ data: 'tags' },
         	{ data: 'short' },
         	{ data: 'status' },
         	{ data: 'actions' },
      	],
   	});

    $('#customSearch').click(function(e){
     	e.preventDefault();
   		 dataTable.draw();
  	});

    $('body').on('click','.disableBlog',function(){

    	var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'update-blog-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'updated'){
				toastr.success('Blog has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
    });

    $('.article_code').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: 'get-category-by-ajax',
        dataType: "json",
        data: {
        term: request.term
      },
      success: function( data ) {
        response($.map( data, function( item )
          {
            return{
              label: item.category_name,
              value: item.category_name,
              id : item.category_id,
            }
          })
        );
      }
    });
    },
    minLength: 1,
    change: function(event,ui){
      $(this).val((ui.item ? ui.item.value : ""));
      $('#category_id').val((ui.item ? ui.item.id : ""));
    },
    open: function() {
      $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
    },
    close: function() {
      $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
    }
  });
})

function readCategoyImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#categoryImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}