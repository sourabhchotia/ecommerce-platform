$(function(){

	$('#userRegistration').validate({
		rules :{
			email : {
				required : true,
				email : true,
			},
			username : {required : true},
			mobile : { required : true, minlength : 10, maxlength : 10, number : true},
			password : { required : true, minlength : 6},
			confirm_password : { required : true, equalTo : '#password'}
		},
		messages :{
			email : {
				required : "Please Enter an Email Address",
				email : "Please Enter a valid Email Address"
			},
			username : "Please Enter Your Name",
			mobile : {
				required : "Please Enter Your Mobile Number",
				minlength : "Please Enter a Valid Number",
				maxlength : "Please Enter a Valid Number",
				number : "Mobile Number Must be Integers only"
			},
			password : {
				required : "Please Provide a Password for Your Account",
				minlength : "Password Must be atleast of 6 Character Long"
			},
			confirm_password : {
				required : "Please Confirm Your Password",
				equalTo : "Password is Not Same as above"
			}
		},
		submitHandler : function(){

			$.ajax({
				url : base_url + 'user-registration-verification',
				type : 'post',
				data : $('#userRegistration').serialize(),
				dataType : 'json'
			})
			.done(function(html){
				console.log(html);
				
				if(html.msg == 'email'){
					toastr.error('This Email id is already registered with us. Please Login or click Forget password in case you have forgot your password.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'phone'){

					toastr.error('This Mobile Number is already registered with us. Please Login or click Forget password in case you have forgot your password.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'error'){

					toastr.error('Technical issue! Please try after sometime.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'done'){

					toastr.success('An OTP has been Sent on your mobile number. Please enter for final Registration Process', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });

					$('#userid').val(html.user_id);
					$("#userRegistration").fadeOut(1000);
        			$("#finalRegistration").slideDown(1000);

				}else if(html.msg == 'resend'){

					toastr.success('You are already registered. Please verify your account by entering OTP that has been sent on your mobile number.', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });

					$('#userid').val(html.user_id);
					$("#userRegistration").fadeOut(1000);
        			$("#finalRegistration").slideDown(1000);
				}else{

					toastr.error('Check console for more details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			});
		}
	});

	$("#finalRegistration").validate({
		rules : {
			otp : {required : true}
		},
		messages : {
			otp : "Please Enter OTP"
		},
		submitHandler : function(){
			$.ajax({
				url : base_url + 'user-registration-completion',
				type : 'post',
				data : $('#finalRegistration').serialize(),
				dataType : 'json'
			})
			.done(function(html){

				if(html.msg == 'invalid'){
					toastr.error('The OTP is Incorrect. Please Enter correct OTP', 'Opps!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'error'){

					toastr.error('Invalid Data Provided. Please Repeat Registration Process', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'done'){

					toastr.success('Registration Process has been completed successfully.', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });

    				setTimeout(function(){
    					window.location.href = base_url;
    				},2000);

				}else{

					toastr.error('Check console for more details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			});
		}
	});


	$('#userLogin').validate({

		rules : {
			username : { required : true},
			password : { required : true, minlength : 6}
		},
		messages : {
			username : "Please Enter Your Mobile/Email",
			password : {
				required : "Please Provide a Password for Your Account",
				minlength : "Password Must be atleast of 6 Character Long"
			},
		},
		submitHandler : function(){

			$.ajax({
				url : base_url + 'user-login',
				type : 'post',
				data : $('#userLogin').serialize(),
				dataType : 'json'
			}).done(function(html){

				if(html.msg == 'email'){

					toastr.error('The Email Address is Incorrect. Please Enter correct Email Address', 'Opps!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'phone'){

					toastr.error('The Mobile Number is Incorrect. Please Enter correct Mobile Number', 'Opps!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'pass'){

					toastr.error('The Password is Incorrect. Please Enter correct Password', 'Opps!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'blocked'){

					toastr.error('Sorry, You have been blocked by the administrative department. Please contact admin for more details', 'Opps!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'done'){

					toastr.success('You have been logged in.', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });

    				setTimeout(function(){
    					window.location.reload();
    				},2000);

				}else{

					toastr.error('Check console for more details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			})
		}
	});


	$('#profileUpdate').validate({

		rules : {
			email : {
				required : true,
				email : true,
			},
			username : {required : true},
			mobile : { required : true, minlength : 10, maxlength : 10, number : true}
		},
		messages :{
			email : {
				required : "Please Enter an Email Address",
				email : "Please Enter a valid Email Address"
			},
			username : "Please Enter Your Name",
			mobile : {
				required : "Please Enter Your Mobile Number",
				minlength : "Please Enter a Valid Number",
				maxlength : "Please Enter a Valid Number",
				number : "Mobile Number Must be Integers only"
			},
		},
		submitHandler : function(){

			$.ajax({

				url : base_url + 'update-profile',
				type : 'post',
				data : $('#profileUpdate').serialize(),
				dataType : 'json',
			})
			.done(function(html){

				if(html.msg == 'otp'){

					$('.otpField').show(1000);
					toastr.success('An OTP has been sent to you for Mobile Number Confirmation. Please Enter OTP', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'incorrect'){
					toastr.error('Incorrect OTP. Please Enter Correct OTP', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else if(html.msg == 'done'){

					toastr.success('Profile has been updated successfully.', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });
					
					setTimeout(function(){
    					window.location.reload();
    				},2000);

				}else if(html.msg == 'error'){

					toastr.error('Technical issue! Please try after sometime.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}else{
					toastr.error('Check console for more details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			})
		}
	});

	$('#passwordChange').validate({
		rules : {
			oldpassword : { required : true, minlength : 6},
			newpassword : { required : true, minlength : 6},
			confirmpassword : {required : true, equalTo : '#profilePassword'}
		},
		messages : {
			oldpassword : {
				required : 'Please Enter Current Password',
				minlength : "Password is invalid"
			},
			newpassword : {
				required : 'Please Enter Current Password',
				minlength : "Password is invalid"
			},
			confirmpassword : {
				required : 'Please Enter Current Password',
				equalTo : "Password Must be same as New Password"
			},
		},
		submitHandler : function(){

			$.ajax({
				url : base_url + 'update-password',
				type : 'post',
				data : $('#passwordChange').serialize(),
				dataType : 'json'
			})
			.done(function(html){

				if(html.msg == 'incorrect'){

					toastr.error('The Current Password is Incorrect.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'done'){

					toastr.success('Password Changed successfully. You have to login again with new password, for an uninterrupted experince.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
					setTimeout(function(){
    					window.location.href = base_url;
    				},4000);

				}else if(html.msg == 'error'){

					toastr.error('Technical Error, Please try after sometime.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				}else if(html.msg == 'redirect'){
    					window.location.href = base_url;
				}else{
					toastr.error('Check console for more details.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				}
			});
		}
	});


	$('#addressForm').validate({
		rules : {
			name : { required : true},
			phone : {required : true, number  :true, minlength : 10, maxlength : 10},
			address1 : {required : true},
			zipcode : { required : true , minlength : 6, maxlength : 6, number : true},
			city : { required : true},
			state : { required : true},
			country : {required : true},
		},
		messages : {
			name : "Please Enter Your Name",
			phone : {
				required : "Please Enter Your Mobile Number",
				minlength : "Please Enter a Valid Number",
				maxlength : "Please Enter a Valid Number",
				number : "Mobile Number Must be Integers only"
			},
			address1 : "Please Enter Your Address",
			zipcode : {
				required : "Please Enter Your Zipcode",
				minlength : "Please Enter a Valid Zipcode",
				maxlength : "Please Enter a Valid Zipcode",
				number : "Zipcode Must be Integers only"
			},
			city : "Please Enter Your City",
			state : "Please Enter Your State",
			country : "Please Enter Your Country",
		},
		submitHandler : function(){

			$.ajax({
				url : base_url + 'save-address',
				type : 'post',
				data : $('#addressForm').serialize(),
				dataType : 'json'
			})
			.done(function(html){

				if(html.msg == 'done'){
					toastr.success('Address added successfully.', 'Added!', { "closeButton": true },'Progress Bar', { "progressBar": true });
					window.location.reload();
				}else{
					toastr.error('Technical issue! Please try after sometime.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}
			})
		}
	});

	$('#zipcode').on('blur',function(){

		var code = $(this).val()
		if(code){
			$.ajax({
				url : base_url + 'check-zip',
				type : 'post',
				data : {code : code},
				dataType : 'json'
			})
			.done(function(html){

				if(html.msg == 'done'){
					$('#city').val(html.city);
					$('#state').val(html.state);
					$('#country').val(html.country)
				}else{
					toastr.error('Delivery Service is currently unavailable at this zipcode.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });

				}
			})
		}
			
	})

	$('#checkDeliver').on('submit',function(e){

		e.preventDefault();

		var code = $('#zipcodeForm').val()
		if(code){
			$.ajax({
				url : base_url + 'check-delivery-status',
				type : 'post',
				data : {code : code},
				dataType : 'json'
			})
			.done(function(html){

				if(html.msg == 'done'){
					toastr.success('Delivery Service is available at this zipcode.', 'Hurrey!', { "closeButton": true },'Progress Bar', { "progressBar": true });
					$('#checkoutButton').attr('disabled',false);
				}else{
					toastr.error('Delivery Service is currently unavailable at this zipcode.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
					$('#checkoutButton').attr('disabled',true);
				}
			})
		}
			
	});


	$('.deleteAddress').on('click',function(){

		var id = $(this).data('id'),
		$currentRow = $(this).parent().parent();

		$.ajax({
			url : base_url + 'delete-address',
			type : 'post',
			data : {id : id},
			dataType : 'json'
		})
		.done(function(html){

			if(html.msg == 'done'){
				toastr.success('Address Deleted successfully.', 'Confirm!', { "closeButton": true },'Progress Bar', { "progressBar": true });
				
				$($currentRow).remove();
				
			}else{
				toastr.error('Technical Error. Please try again.', 'Error!', { "closeButton": true },'Progress Bar', { "progressBar": true });
			}
		})
	})
});