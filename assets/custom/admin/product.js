$(function(){

	$('.catChange').on('change',function(){

    var num = 0;
		$.ajax({
			url : base_url + 'admin/products/get-attributes-by-category',
			type : 'post',
			data : { id : $(this).val(), num : 1},
			dataType : 'html'
		})

		.done(function(html){

			$('#generalInfo').html(html);

      if(html != '<h3>No Attributes for This Category<h3>'){
        $('#totalAttributes').val(num + 1);
        $('#addMoreAttribute').prop('disabled',false);
      }
		});
	});

	$('#addMoreAttribute').on('click',function(){

		var id = '';
    var inner = $('#innerCat').val();
    var sub = $('#subCat').val();
    var main = $('#mainCat').val();
    var parent = $('#parentCat').val();

    if(inner){
      id = inner;
    }else if(sub){
      id = sub;
    }else if(main){
      id = main;
    }else if(parent){
      id = parent;
    }
		var num = $('#generalInfo tr:nth-child(2n)').length;

		$.ajax({
			url : base_url + 'admin/products/get-attributes-by-category',
			type : 'post',
			data : { id : id, num : num + 1},
			dataType : 'html'
		})

		.done(function(html){

			$('#generalInfo').append(html);
			$('#totalAttributes').val(num + 1);
		});
	});


	$('body').on('click','.disableProduct',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}

		$.ajax({
			url : 'update-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'updated'){
				toastr.success('Product has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	})

	var stockTable = $('#stockTable').DataTable({
      	'processing': true,
      	'serverSide': true,
      	"bSort" : false,
      	'serverMethod': 'post',
      	'ajax': {
          	'url': 'get-products-stock',
          	type : 'post',
          	data : function(data){
          		var fromDate =$('#fromDate').val(); 
          		var ToDate =$('#ToDate').val();
          		var art_id =$('#art_id').val();
          		data.from = fromDate;
          		data.to = ToDate;
          		data.art_id = art_id;
          	},
          	error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            },
      },
      'columns': [
      	 	{data : 'product_image'},
         	{ data: 'product_sku' },
         	{ data: 'product_name' },
         	{ data: 'category' },
         	{ data: 'stock' },
         	{ data: 'actions' },
      	],
   	});


	var dataTable =$('#empTable').DataTable({
      	'processing': true,
      	'serverSide': true,
      	"bSort" : false,
      	'serverMethod': 'post',
      	'ajax': {
          	'url': 'get-products-listing',
          	type : 'post',
          	data : function(data){
          		var fromDate =$('#fromDate').val(); 
          		var ToDate =$('#ToDate').val();
          		var art_id =$('#art_id').val();
              
          		data.from = fromDate;
          		data.to = ToDate;
          		data.art_id = art_id;
          	},
          	error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            },
      },
      'columns': [
      		{data : 'checkboxes'},
      	 	{data : 'product_image'},
         	{ data: 'product_sku' },
         	{ data: 'product_name' },
         	{ data: 'category' },
         	{ data: 'mrp' },
         	{ data: 'sale_price' },
         	{ data: 'stock' },
         	{ data: 'status' },
         	{ data: 'actions' },
      	],
   	});


	var exceptionTable =$('#zero_config').DataTable({
      	'processing': true,
      	'serverSide': true,
      	"bSort" : false,
      	'serverMethod': 'post',
      	'ajax': {
          	'url': 'sale-exception-product',
          	type : 'post',
          	data : function(data){
          		var fromDate =$('#fromDate').val(); 
          		var ToDate =$('#ToDate').val();
          		var art_id =$('#art_id').val();
          		data.from = fromDate;
          		data.to = ToDate;
          		data.art_id = art_id;
          	},
          	error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            },
      },
      'columns': [
      		{data : 'checkboxes'},
      	 	{data : 'product_image'},
         	{ data: 'product_name' },
         	{ data: 'category' },
      	],
   	});


    $('#customSearch').click(function(e){
     	e.preventDefault();
   		 dataTable.draw();
  	});

  	$('#customSearchStock').click(function(e){
     	e.preventDefault();
   		 stockTable.draw();
  	});


  	$('body').on('click','#selectAll',function(){
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

    $('body').on('click','.checkbox',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#selectAll').prop('checked',true);
        }else{
            $('#selectAll').prop('checked',false);
        }
    });


  $("#importFile").on('change',function(){
	    readCategoyImage(this);
	});

	$('#ProductImage').on('change',function(){		
	    readProductImage(this);
	});

	$('#productForm').on('change','.ProductImage',function(){
	    readComboImage(this);
	});

	$('#uploadMedia').on('submit',function(e){
		e.preventDefault();

		var data = new FormData($('#uploadMedia')[0]);

		$.ajax({
			url : 'save-media',
			type : 'post',
			data : data,
			dataType : 'json',
			cache: false,
		    contentType: false,
		    processData: false,
		})
		.done(function(html){
			
			if(html.msg == 'Uploaded succefuly'){
				toastr.success('Media has been Uploaded successfuly.', 'Welldone!', { "closeButton": true }, { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);

			}else if(html.msg == 'Please Select Images First'){

				toastr.warning('Please Select Images First.', 'Opps!', { "closeButton": true }, { "progressBar": true });

			}else{

				html.each(function(k, i){
					$('#error').html('<div class="alert alert-danger alert-rounded">'+k+'\
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>\
                                </div>');
				});
			}
		});
	});

	$('.delete-media').on('click',function(e){
		e.preventDefault();

		$.ajax({
			url : 'delete-media',
			type : 'post',
			data : {id : $(this).data('id')},
			dataType : 'json',
		})
		.done(function(html){
			
			if(html.msg == 'deleted'){
				toastr.success('Media has been removed successfuly!','Completed',{"closeButton": true}, { "progressBar": true });

			}else{
				toastr.error('Error! Please try Again.','Error',{"closeButton": true}, { "progressBar": true });
			}
		})
	});


	$('body').on('click','.update_stock',function(){

		var id = $(this).data('id');

		var qty = $('input[name="qty_'+id+'"]').val();

		$.ajax({
			url : 'update-stock',
			type : 'post',
			data : { id : id, stock : qty},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'updated'){
				toastr.success('Stock has been Updated successfuly!','Completed',{"closeButton": true}, { "progressBar": true });
			}else if(html.msg == 'error'){

				toastr.error('Error! Please try Again.','Error',{"closeButton": true}, { "progressBar": true });

			}else{
				console.log(html);
				toastr.error('Undefined Error! Please Check Console for details','Error',{"closeButton": true}, { "progressBar": true });
			}
		})

	});


  $('#wholesaleProduct').autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: 'get-product-by-ajax',
        dataType: "json",
        data: {
        term: request.term
      },
      success: function( data ) {
        response($.map( data, function( item )
          {
            return{
              label: item.product_name,
              value: item.product_name,
              id : item.product_id,
            }
          })
        );
      }
    });
    },
    minLength: 1,
    change: function(event,ui){
      $(this).val((ui.item ? ui.item.value : ""));
      $('#wholesaleProductId').val((ui.item ? ui.item.id : ""));
    },
    open: function() {
      $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
    },
    close: function() {
      $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
    }
  });


  $('#wholesaleRateForm').on('submit',function(e){

    e.preventDefault();

    $.ajax({

      url : 'save-wholesale-rate',
      type: 'post',
      data : $(this).serialize(),
      dataType : 'json',
    })
    .done(function(html){

      if(html.msg == 'inserted'){
        toastr.success('Wholesale has been Created successfuly!','Completed',{"closeButton": true}, { "progressBar": true });
        setTimeout(function(){ window.location.reload(); }, 3000);
      }else if(html.msg == 'updated'){
        toastr.success('Wholesale has been Updated successfuly!','Completed',{"closeButton": true}, { "progressBar": true });
        setTimeout(function(){ window.location.reload(); }, 3000);
      }else if(html.msg == 'already'){
        toastr.error('Wholesale Rate for this product between this range already exists!','Opps',{"closeButton": true}, { "progressBar": true });
      }else{
        toastr.error('Stock has been Updated successfuly!','Error!',{"closeButton": true}, { "progressBar": true });
      }
    })
  })
});

function readProductImage(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#ProductImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readComboImage(input){

	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $(input).parent().parent().parent().prev().find('.ProductImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}
function readCategoyImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#importFilePreview').html(input.files[0].name);
        }

        reader.readAsDataURL(input.files[0]);
    }
}