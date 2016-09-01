$(document).ready(function(){
	var website_content = '';
	$('#grab-button').click(function() {
	    var blog_link = $('#input-url').val();

	    $.ajax({
	    	type: 'POST',
	        url: 'getBlogContent.php',
	        data: { "blog-link" : blog_link },
	        success: function(response) {
	           $('#result-section').html(extractContent(response));
	        }
	    });
	});

function extractContent(word)
{
	var start_index = word.search('<div class="section-inner layoutSingleColumn">');
	word  = word.substring(start_index);
	var end_index = word.search('</main>');

	word = word.substring(0, end_index+6);

	return filterIt(word);
}
function filterIt(word)
{
	//removing images
	word = word.replace(/<figure\b[^>]*>(.*?)<\/figure>/g , '');
	//remove titles
	word = word.replace(/<h1\b[^>]*>(.*?)<\/h1>/g, '').replace(/<h2\b[^>]*>(.*?)<\/h2>/g, '');
	//remove <p> tag and spans
	//
	word = word.replace(/<p[^>]*.>/g , '').replace(/<\/p>/g , ' ').replace(/<span[^>]*.>/g , ' ').replace(/<\/span>/g , ' '); 
	//remove last section and div of this section
	word = word.replace(/<section\b[^>]*>(.*?)<\/section>/g, '').replace(/<div[^>]*.>/g , ' ').replace(/<\/div>/g , ' ');
	word = word.replace(/<[^>]*.>/g, ' ');
	return word;

}
});
// 