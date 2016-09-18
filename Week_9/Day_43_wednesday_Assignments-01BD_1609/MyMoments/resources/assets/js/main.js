function like(post_id) {
	//getting html element to change 
	var post_like_image = document.getElementById('img-'+post_id);
	var likes_count_span = document.getElementById('post-'+post_id+'-likes-count');
	var likes_count = parseInt(likes_count_span.innerHTML);

	//get previous liking status
	var previous_like_status = post_like_image.getAttribute("x-data");

	//get token 
	var token = document.getElementsByTagName('meta')[4].getAttribute("content");

	//do a post request 
	var data="post_id="+post_id+"& _token="+token;
	xmlHttpRequest("/MyMoments/public/home/like", data);

	if(previous_like_status) {
		post_like_image.setAttribute("src", "/MyMoments/public/images/emptyheart.png");
		post_like_image.setAttribute("x-data", "");
		//decrease likes count
		likes_count--;

	} else {
		post_like_image.setAttribute("src", "/MyMoments/public/images/liked.png");
		post_like_image.setAttribute("x-data", "1");
		likes_count++;
	}
	
	likes_count_span.innerHTML = likes_count;
}

function comment(post_id) {
	var comment_input = document.getElementById('comment-input-'+post_id);
	var post_comments = document.getElementById('post-item-image-comments-'+post_id);

	//create comment object
	var new_comment = document.createElement("p");
	var comment_node = document.createTextNode('you : '+comment_input.value);
	new_comment.appendChild(comment_node);

	//append comment to comments box
	post_comments.appendChild(new_comment);

	//data to send
	var token = document.getElementsByTagName('meta')[4].getAttribute("content");
	//do a post request 
	var data="post_id="+post_id+"& comment_text="+comment_input.value+"& _token="+token;
	xmlHttpRequest("/MyMoments/public/home/comment", data);

	//clear input
	comment_input.value = "";
}

function xmlHttpRequest(link, data) {
	//do a post request 
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", link, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}