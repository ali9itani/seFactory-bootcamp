function like(post_id) {

	var post_like_image = document.getElementById('img-'+post_id);

	//get previous liking status
	var previous_like_status = post_like_image.getAttribute("x-data");

	//get token 
	var token = document.getElementsByTagName('meta')[4].getAttribute("content");

	//do a post request 
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "/MyMoments/public/home/like", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data="post_id="+post_id+"& _token="+token;
    xmlhttp.send(data);

	if(previous_like_status) {
		post_like_image.setAttribute("src", "/MyMoments/public/images/emptyheart.png");
		post_like_image.setAttribute("x-data", "");
	} else {
		post_like_image.setAttribute("src", "/MyMoments/public/images/liked.png");
		post_like_image.setAttribute("x-data", "1");
	}
	
}
