$(function(){

	$("#adminImage").on('change',function(){
	    readCategoyImage(this);
	});


	$('#update_profile').on('submit',function(e){

		e.preventDefault();

		var data = new FormData($('#update_profile')[0]);

		$.ajax({
			url : 'update-profile',
			type : 'post',
			data : data,
			dataType : 'json',
			cache: false,
		    contentType: false,
		    processData: false,
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Profile has been updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}else{
				toastr.error('Technical Error, Please try again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});

	$('#changePassword').validate({

		rules : {
			old_password : { required  :true},
			new_password : { required : true, minlength : 6},
			confirm_password : { required : true, equalTo : '#new_password'}
		},
		messages : {
			old_password : "Please Enter Your Current Password",
			new_password : { 
				required : "Please Enter New Password", 
				minlength : "Password Must be atleast of 6 Characters"
			},
			confirm_password : { 
				required : "Please Confirm Your Password", 
				equalTo : 'Password is not same as above'
			}
		},

		submitHandler : function(form){
			$.ajax({
				url : 'change-password',
				type : 'post',
				data : $('#changePassword').serialize(),
				dataType : 'json',
			})
			.done(function(html){

				if(html.msg == 'done'){
					toastr.success('Profile has been updated.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
					
					setTimeout(function(){ 
						window.location.href = base_url + 'admin/dashboard';
					},3000);

				}else if(html.msg == 'invalid'){
					toastr.error('Old Password is incorrect.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}else{
					toastr.error('Technical Error, Please try again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			});
		}
	});

	$('#adminForm').validate({
		rules : {
			adminName : { required : true},
			adminEmail : { required : true, email : true},
			adminMobile : { required : true, minlength : 10, maxlength : 10, number : true},
			adminRole : { required : true}
		},
		messages : {
			adminName : "Please Provide a Name for admin",
			adminEmail : { 
				required : "Please Provide a Email Address", 
				email : "Please Provide a Valid Email Address"
			},
			adminMobile : { 
				required : "Please Provide a Mobile Number", 
				minlength : "Please Provide a Valid Mobile Number", 
				maxlength : "Please Provide a Valid Mobile Number", 
				number : "Please Provide a Valid Mobile Number"
			},
			adminRole : "Please Select Role of this Admin"
		},
		submitHandler : function(form){
			var data = new FormData($('#adminForm')[0]);

			$.ajax({
				url : 'save-admin',
				type : 'post',
				data : data,
				dataType : 'json',
				cache: false,
			    contentType: false,
			    processData: false,
			})
			.done(function(html){

				if(html.msg == 'inserted'){

					toastr.success('Admin has been Added Succefully.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'email'){

					toastr.error('Admin With this Email already exists.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'mobile'){

					toastr.error('Admin With this Mobile already exists.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'updated'){

					toastr.success('Admin has been Updated Succefully.', 'Welldone', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}else{
					toastr.error('Technical Error, Please try again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			});
		}
	});

	$('.editAdmin').on('click',function(){

		$.ajax({

			url : 'edit-admin',
			type : 'post',
			data : { id : $(this).data('id')},
			dataType : 'json'
		})
		.done(function(html){

			$('#adminName').val(html.admin_display_name);
			$('#adminId').val(html.admin_id);
			$('#adminEmail').val(html.admin_email);
			$('#adminMobile').val(html.admin_phone);
			$('#adminRole option[value="'+html.admin_role+'"]').prop("selected", true);

			var src = base_url + 'uploads/admin/thumbs/'+html.filename+'-150x150.'+html.ext; 

			$('#adminImagePreview').prop('src',src);

		});
	});

	$('.disableAdmin').on('click',function(){

		var message = 'enabled';

		if($(this).data('status') == '0'){
			 message = 'disabled';
		}
		$.ajax({
			url : 'change-admin-status',
			type : 'post',
			data : { id : $(this).data('id'), status : $(this).data('status')},
			dataType : 'json',
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Admin has been '+ message+'.', 'Welldone!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				setTimeout(function(){ window.location.reload(); }, 3000);
			}else{
				toastr.error('Please try again after some time.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	});
});


function readCategoyImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#adminImagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}