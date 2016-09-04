$(document).ready(function(){
	$('#grab-button').click(function() {
		//to empty resulted text from previous process
		clearFields();
		var blog_link = $('#input-url').val();
		if(validateUrl(blog_link)) {
			$.ajax({
				type: 'POST',
				url: 'getBlogContent.php',
				data: { "blog-link" : blog_link },
				success: function(response) {
					console.log(response);
					if(response == "-1")
					{
						$('#status-section').text('Invalid Blog Link');
					} else {
						var text_to_summarize  = extractContent(response);
						$('#original-text-section').html(text_to_summarize);
						summarizeIt(text_to_summarize);
					}
				}
			});
			//add loader bar
			loaderImage();
		}
	});

	function clearFields()
	{
		$('.resulted-texts').empty();
	}

	function extractContent(text)
	{
		var result = '';
		var dummyDiv = document.createElement("div"); 
		dummyDiv.innerHTML = text;

		var pTags = dummyDiv.querySelectorAll('.section-content p,.section-content ul');

		for (var i = 0 ; i < pTags.length ; i++) {
			result += " "+pTags[i].innerHTML ;
		}

		//remove any html tag : a li ul span ...
		return  result.replace(/<[^>]*.>/g, ' ');
	}

	function summarizeIt(text_to_summarize)
	{
		$.ajax({
			type: 'POST',
			url: 'summarizeIt.php',
			data: { "text" : text_to_summarize },
			success: function(response) {
				var result = JSON.parse(response);
				$('#result-section').html(result['sentences']);
				//remove loader bar
				loaderImage();
	        }
	    });
	}

	function validateUrl(link)
	{
		//ensure that link belong to medium blog
		if(link.match(/https\:\/\/medium.*.com\//i)) {
			return true;
		} else {
			$('#status-section').text('Invalid URL')
			return false;
		}
	}

	//display undisplay loader 
	function loaderImage() 
	{
		if($('#loader-img').css('display') == 'block')
		{
			$('#loader-img').css('display','none'); 
		} else {
			$('#loader-img').css('display','block'); 
		}

	}

});
// 