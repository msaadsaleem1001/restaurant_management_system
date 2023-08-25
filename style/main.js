 $(document).ready(function (){
	
// 	// DROPDOWN TOGGLE
	$('.dropdown-link').on('click', function(e) {
		e.stopPropagation();
		if($(this).siblings(".dropdown-content").hasClass("show"))
		{
			$(".dropdown-content").removeClass("show");
		}
		else 
		{
			$(".dropdown-content").removeClass("show");
			$(this).siblings(".dropdown-content").addClass("show");
		}
	});
	
	$(".dropdown-content").on("click",function(e)
	{
		e.stopPropagation();
	})

	$(document).click(function(){
    	$(".dropdown-content").removeClass("show");
	});
	
	$(".dropdown-list").on("click",function()
	{
		$(this).siblings(".list-all-subtypes").toggleClass("show")
	});
	
	$(".toggle-left-navbar").on("click",function()
	{
		$(".left-nav-dropdown").toggleClass("active");
		$(".content-bar").toggleClass("active");

	});
	
	$("#sign-up-class").on("click",function()
	{
		$("#login-form").toggleClass("active");
		$("#sign-up-form").toggleClass("active");
	});
});





$(document).ready(function(){  
	$('#Add_Item').click(function(){  
		 var image_name = $('Photo').val();  
		 if(image_name == '')  
		 {  
			  alert("Please Select Image");  
			  return false;  
		 }  
		 else  
		 {  
			  var extension = $('#Photo').val().split('.').pop().toLowerCase();  
			  if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
			  {  
				   alert('Invalid Image File');  
				   $('#Photo').val('');  
				   return false;  
			  }  
		 }  
	});  
});  





