jQuery(document).ready(function($) {
	$('#exportproducts').click(function(e){
		e.preventDefault();

		 $.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            dataType: 'json',
			 data: {
                action: 'excelify_ajax_action',
                
            },
            success: function(response) {
               
                if (response.success) {
                   
                    window.location.href = response.data;
                } else {
                  
                    console.log(response.data);
                }
            },
            error: function(xhr, status, error) {
               
                console.log(error);
            },
            complete: function() {
               
            }
        });
	});
});