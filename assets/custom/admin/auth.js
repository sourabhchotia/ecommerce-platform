$(function(){
	$('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp(1000);
        $("#recoverform").fadeIn(1500);
    });
    $('#to-login').on("click", function() {
        $("#recoverform").fadeOut(1000);
        $("#loginform").slideDown(1500);
        
    });

    $('#adminLogin').validate({
    	rules : {
    		email : { email : true, required : true },
    		password : {required : true}
    	},

    	messages : {
    		email : {
    			email : 'Please Enter a Valid Email Address',
    			required : 'Please Enter a Email Address'
    		},
    		password :  'Please Enter Your Password'
    	},
    	submitHandler : function(form){

    		$.ajax({
    			url : 'admin-login',
    			type : 'POST',
    			data : $(form).serialize(),
    			dataType : 'json',
    			cache: false,             
				processData:false,
    		})
    		.done(function(html){
    			
    			console.log(html);

    			if(html.msg == 'loggedin'){

    				toastr.success('You have Been Logged In.', 'Welcome', { "closeButton": true },'Progress Bar', { "progressBar": true });

    				setTimeout(function(){
    					window.location.href = 'admin/dashboard';
    				},2000);
    			}else if(html.msg == 'password error'){
    				
    				toastr.error('The Password You have entered is incorrect.', 'Incorrect Password', { "closeButton": true },'Progress Bar', { "progressBar": true });

    			}else if(html.msg == 'email error'){
    				
    				toastr.error('The Email You have entered is Not Registered.', 'No Match Found', { "closeButton": true },'Progress Bar', { "progressBar": true });

    			}else{
    				
    				toastr.error('Please try again after some time.', 'Unknown Error', { "closeButton": true },'Progress Bar', { "progressBar": true });
    			}
    		})
    	}
    })
})