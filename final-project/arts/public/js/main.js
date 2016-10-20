//send ajax request to save profile new edits
function saveProfileData(){

	// empty old list of errors
	$("#profile-save-status-msg").empty();

	//getting form data
	var form = document.getElementById('edit-profile-form');
	var formData = new FormData(form);
	formData.append('fullName', form.elements['fullName'].value);
	formData.append('bio', form.elements['bio'].value);
	formData.append('birthDate', form.elements['birthDate'].value);
	formData.append('website', form.elements['website'].value);
	
	var editProfileSelectArts = document.getElementById('edit-profile-select');
	var selectedArts = getSelectValues(editProfileSelectArts);
	formData.append('select', selectedArts);
	
	imageToUploadCheck = document.getElementById("fileToUpload").files.length

	//check if image is selected
	if( imageToUploadCheck != 0 ){
		formData.append('image', $('input[type=file]')[0].files[0]); 
	}
	
	$.ajax({
	   	data: formData,
		type: 'POST',
	   	contentType: false,
		cache: false,
		processData:false,
	  	success: function(results) {
			// display new list of results
			$('#profile-page-alert').html('<div id="new-post-msg-box" class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><i class="fa fa-coffee"></i></div>');
	   		for (var i = 0; i < results.length; i++) {
	   			$("#new-post-msg-box").append(results[i]);
			}

			//change profile image
			if( imageToUploadCheck != 0 ) {
				var  imgId = $("#edit-profile-img").attr("user-data-img-id"); 

				$("#edit-profile-img").load(function() {
				    $(this).hide();
				    $(this).fadeIn('slow');
				}).attr('src', '../img/profile-photo/'+imgId+
										 ".jpg?" + new Date().getTime());
				// empty uploader
				$("#fileToUpload").replaceWith($("#fileToUpload").val('')
								  .clone(true));
			}
	  	},
		error: function() {
			  $('#profile-page-alert').html('<div id="new-post-msg-box" class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><i class="fa fa-coffee"></i>failed to save</div>');
		}
	});
}

// Return an array of the selected opion values
// select is an HTML select element
function getSelectValues(select) {
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
    }
  }
  return result;
}



/*for sending a add post with data to server*/

//to display images in browser before upload
 function displayImages(input) {

 		var inputs = input.files;
 		//display images in areverse order 
 		for (var i = inputs.length - 1; i >= 0; i--) {
 			
 			var reader = new FileReader();
 			reader.onload = function (e) {

 				var newImg = document.createElement("img");
 				newImg.src = e.target.result;
 				newImg.style.width= '100px';
 				newImg.style.height= '100px';

                document.getElementById('new-post-photos-display').appendChild(newImg); 
            }
            
            reader.readAsDataURL(inputs[i]);
 		}
    }
    
$("#post-images-uploader").change(function(){
    displayImages(this);
});

function validateImageUploader(){
    var imgUploader = document.getElementById('post-images-uploader');
    if(imgUploader.files.length === 0){
        alert("Image/s Required");
        imgUploader.focus();
        return false;
    } else {
    	return true;
    }
}

//on clicking a submit of post - it sends ajax request
function uploadPost() {

	if(validateImageUploader()){
		var postImageForm = document.getElementById('post-images-form');
	    var form = postImageForm;
	    var formdata = false;

	    if (window.FormData){
	        formdata = new FormData(postImageForm);
	    }

	    $.ajax({
	        data        : formdata ? formdata : form.serialize(),
	        cache       : false,
	        contentType : false,
	        processData : false,
	        type        : 'POST',
	        success     : function(data, textStatus, jqXHR){
	            bootstrap_alert.warning(data);

	            // empty uploader and form
	            document.getElementById("post-images-form").reset();
				$("#post-images-uploader").replaceWith($("#post-images-uploader").val('')
								  .clone(true));
	        },
	        errors		:  function() {
			   bootstrap_alert.warning('Error');
			}
	    });
	}
	
}

bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
            $('#new-post-msg-box').html('<div  class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
}


function follow()
{
	//getting form data
	var form = document.getElementById('follow-form');
	var formData = new FormData(form);

	var userName = document.getElementById('profile-username-span').innerHTML;

	formData.append('userName', userName);

	$.ajax({
		data        : formData,
		cache       : false,
		contentType : false,
		processData : false,
		type        : 'POST',
		success     : function(data, textStatus, jqXHR){
			changeFollowButton(data);
		},
	});
}
//switch style for follow button in profile pag
function changeFollowButton(status) {
	if(status == 0) {
		//follow 
		document.getElementById('follow-button').className = 'follow-button';
		document.getElementById('follow-icon').className = 'fa fa-plus-circle';
		document.getElementById('follow-text').innerHTML = 'follow';
	} else {
		//unfollow - following
		document.getElementById('follow-button').className = 'following-button';
		document.getElementById('follow-icon').className = 'fa fa-times-circle';
		document.getElementById('follow-text').innerHTML = 'following';
	}
}

//toswitch between folowers/following lists in profile page
function followListDisplay(num) {

	var followers_list = document.getElementById("followers-list");
	var following_list = document.getElementById("following-list");
	var following_count_buttons = document.getElementsByClassName("following-count");

	if(num == 0){	
		following_count_buttons[0].style.backgroundColor = "wheat";
		following_count_buttons[1].style.backgroundColor = "white";
		followers_list.style.display = "block";
		following_list.style.display = "none";

	} else if (num == 1) {
		following_count_buttons[0].style.backgroundColor = "white";
		following_count_buttons[1].style.backgroundColor = "wheat";
	    followers_list.style.display = "none";
		following_list.style.display = "block";
	}
}

//add a comment on post
function comment()
{
	//getting form data
	var form = document.getElementById('comment-form');
	var formData = new FormData(form);

	var formData = new FormData(form);
	formData.append('comment', formData.get('comment'));
	formData.append('postId', $(form).attr("data-id"));

	//add comment to comments box
	var commentsBox = document.getElementById('comments-box');


	//create comment object
	var new_comment = document.createElement("p");
	var b_tag = document.createElement("b");

	var user = document.createTextNode('you : ');
	var comment_node = document.createTextNode(formData.get('comment'));

	b_tag.appendChild(user);
	

	//append comment to comments box
	commentsBox.appendChild(new_comment);

	$.ajax({
		url         : 'comment',
		data        : formData,
		cache       : false,
		contentType : false,
		processData : false,
		type        : 'POST',
		success     : function(data, textStatus, jqXHR){
			new_comment.appendChild(b_tag);
			new_comment.appendChild(comment_node);
			form.reset()
		},
	});
}