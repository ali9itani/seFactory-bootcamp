$(document).ready(function(){
	var website_content = '';
	$('#grab-button').click(function() {
	    var blog_link = $('#input-url').val();

	    $.ajax({
	    	type: 'POST',
	        url: 'getBlogContent.php',
	        data: { "blog-link" : blog_link },
	        success: function(response) {
	        	var text_to_summarize  = extractContent(response);
	           summarizeIt(text_to_summarize);
	        }
	    });
	});

	function extractContent(text)
	{
		var start_index = text.search('<div class="section-inner layoutSingleColumn">');
		text  = text.substring(start_index);
		var end_index = text.search('</main>')-6;

		text = text.substring(0, end_index+6);

		return filterIt(text);
	}

	function filterIt(text)
	{
		//removing images
		text = text.replace(/<figure\b[^>]*>(.*?)<\/figure>/g , '');
		//remove titles
		text = text.replace(/<h1\b[^>]*>(.*?)<\/h1>/g, '').replace(/<h2\b[^>]*>(.*?)<\/h2>/g, '');
		//remove <p> tag and spans
		text = text.replace(/<p[^>]*.>/g , '').replace(/<\/p>/g , ' ').replace(/<span[^>]*.>/g , ' ').replace(/<\/span>/g , ' '); 
		//remove last section and div of this section
		text = text.replace(/<section\b[^>]*>(.*?)<\/section>/g, '').replace(/<div[^>]*.>/g , ' ').replace(/<\/div>/g , ' ');
		text = text.replace(/<[^>]*.>/g, ' ');
		return text;
	}

	function summarizeIt(text_to_summarize) {
		$.ajax({
			type: 'POST',
			url: 'summarizeIt.php',
			data: { "text" : text_to_summarize },
			success: function(response) {
			$('#result-section').html(response);
	        }
	    });
	}

});
// 