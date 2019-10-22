$(function(){

	$('.add_wishlist').on('click',function(){

		$.ajax({
			url : base_url + 'add-to-wishlist',
			type : 'post',
			data : { productid : $(this).data('combo-id') },
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'login'){

				toastr.error('Please login first, in order to add product into your wishlist', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else if(html.msg == 'error'){

				toastr.error('Technical Error! Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else if(html.msg == 'already'){

				toastr.warning('Product is already in wishlist.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else if(html.msg == 'done'){

				toastr.success('Product Added to your wishlist successfully', 'Whislist Updated!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else{
				console.log(html);
				toastr.error('Unidentified error, Please check console for more details', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}
		});
	});

	$('.remove_item').on('click',function(){

		var $this = $(this);

		$.ajax({
			url : base_url + 'remove-wishlist-product',
			type : 'post',
			data : { wishid : $this.data('combo-id')},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){

				toastr.success('Product Removed from your wishlist successfully', 'Whislist Updated!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				$this.parent().parent().remove();
			}else if(html.msg == 'error'){

				toastr.error('Technical Error! Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});

	$('.add_to_cart').on('click',function(){

		var qty = $(this).parent('div').find('#minQty').val();

		if($('input[name="qty"]').val() != undefined){
			qty = $('input[name="qty"]').val();
		}

		$.ajax({
			url : base_url + 'add-to-cart',
			type : 'post',
			data : { productid : $(this).data('combo-id'), qty : qty, type : $(this).data('type') },
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'already'){

				toastr.warning('Product is already in Cart.', 'Opps!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else if(html.msg == 'stockout'){

				toastr.error('Product went out of stock or the quantity you want is not available.', 'Out of Stock!', { "closeButton": true },'Progress Bar', { "progressBar": true });

			}else if(html.msg == 'done'){

				toastr.success('Product Added to your Cart successfully', 'Cart Updated!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				$('.ps-cart__toggle span').html(html.count);

				setTimeout(function(){
					window.location.href = base_url + 'cart.html';
				},2000);
				
			}else if(html.msg == 'error'){

				toastr.error('Technical Error! Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			
			}else{
				console.log(html);
				toastr.error('Unidentified error, Please check console for more details', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		});
	});


	$('#comboColor').on('change',function(){

		// var $size = $('#comboSize').val();
		var $color = $('#comboColor').val();
		// var $product = $('#productid').val();

		$.ajax({
			url : base_url + 'change-combination-by-id',
			type : 'post',
			data : {color : $color},
			dataType : 'json',
		})
		.done(function(html){

			window.location.href = html.slug;
		})
	});

	$('.emptyCartItem').on('click',function(){

		var $this = $(this),
		type = $(this).data('type'),
		id = $(this).data('id'),
		$totalRows = $($this).parent().parent();

		$.ajax({
			url : base_url + 'delete-cart-item',
			type : 'post',
			data : { id : id, type : type},
			dataType : 'json'
		})
		.done(function(html){

			console.log(html);

			if(html.msg == 'done'){
				if(type == 'single'){
					toastr.success('Product Removed From your Cart successfully', 'Cart Updated!', { "closeButton": true },'Progress Bar', { "progressBar": true });
					
					$('#subAmount').html(html.subtotal);
					$('#disAmount').html(html.discount);
					$('#totalAmount').html(html.total);

					$($totalRows).remove();

				}else{
					window.location.reload();
				}
				
			}else{
				toastr.error('Technical Error! Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});


	$('.updateCart').on('click',function(){

		var id = $(this).data('id'),
		qty = $(this).parent().find('input[name="qty"]').val();

		$.ajax({

			url : base_url + 'update-cart',
			type : 'post',
			data : { id : id, qty : qty},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){

				toastr.success('Cart updated successfully', 'Cart Updated!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				$('#subAmount').html(html.subtotal);
				$('#disAmount').html(html.discount);
				$('#totalAmount').html(html.total);
				
			}else if(html.msg == 'error'){

				toastr.error('Technical Error! Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})

	});

	$('.colorFilter').on('click',function(){

		var $color = $("input[name='allColors[]']")
              .map(function(){return $(this).val();}).get();

		var value = $(this).data('value');
		var colors = getUrlParameter('color');
		if(colors){
			if(jQuery.inArray(value, $color) !== -1){
				colors = colors.replace(value, "");
			}else{
				colors = colors + ',' + value;
			}
		}else{
			colors = value;
		}
		
		var url = new URL(window.location.href);
		var query_string = url.search;
		var search_params = new URLSearchParams(query_string); 
		search_params.set('color', colors);
		url.search = search_params.toString();
		var new_url = url.toString();
		window.location.href = new_url;

	});

	$('.priceFilter').on('click',function(){

		var value = $(this).data('value');
		
		var url = new URL(window.location.href);
		var query_string = url.search;
		var search_params = new URLSearchParams(query_string); 
		search_params.set('sortby', value);
		url.search = search_params.toString();
		var new_url = url.toString();
		window.location.href = new_url;
	})


	
})

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};