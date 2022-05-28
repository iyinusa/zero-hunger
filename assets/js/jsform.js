/**
* Creator: I. Kennedy Yinusa
* Email: iyinusa@yahoo.co.uk
* Website: http://iyinusa.kenafftech.com
* Module/App: Js Form
*/

$(function() {
    // Get the form.
    var form = $('#bb_ajax_form');

    // Get the messages div.
    var formMessages = $('#bb_ajax_msg');

    // Set up an event listener for the contact form.
	$(form).submit(function(event) {
    	// Stop the browser from submitting the form.
    	event.preventDefault();

    	// Serialize the form data.
		var formData = $(form).serialize();
		
		// show prograss loading
		$(formMessages).html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
		
		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			//dataType: 'html',
			data: formData
		}).done(function(msg) {
			// Set the message text.
			$(formMessages).html(msg);
			form.get(0).reset(); // clear all form data
			$('#bb_ajax_reload').load(location.href + ' #bb_ajax_reload'); // reload div
			//$(".modal").modal("hide"); // hide pop-up, if any
		}).fail(function(data) {
			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! An error occured and your message could not be sent.');
			}
		});
	});
	
	//////////===== Dynamic Modal Pop-up ===/////////
	$(".pop").click(function(){
		var pageTitle = $(this).attr('pageTitle');
		var pageName = $(this).attr('pageName');
		$(".modal .modal-title").html(pageTitle);
		$(".modal .modal-body").html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> Content loading please wait...</div>');
		$(".modal").modal("show");
		$(".modal .modal-body").load(pageName);
  	});
});