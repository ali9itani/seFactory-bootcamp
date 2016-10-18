// hide(also if outside menu click)/unhide logout menu
document.addEventListener('click', function(e) {
	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
	if(sPage != ""){	
		var logout_block = document.getElementById("header-options-block");
	    if(e.target.id == 'options-icon') {
			var visibility = getStyleValue(logout_block, 'visibility'); 
			if(visibility == "hidden"){
				logout_block.style.visibility = "visible";
			} else {
				logout_block.style.visibility = "hidden";
			}
	    } else {
	    	logout_block.style.visibility = "hidden"
	    }
	}
});

// get value of specific applied attribute
function getStyleValue(elem, style_name) {
	var win = document.defaultView || window, style;
	if(win.getComputedStyle) { /* Modern browsers */
		style = win.getComputedStyle(elem, '');
		for (var i=0; i<style.length; i++) {
			if(style[i] == style_name) {
				return style.getPropertyValue(style[i]);
			}
		}
	} else if (elem.currentStyle) { /* IE */
		style = elem.currentStyle;
		for (var name in style) {
			if(name == style_name) {
				return style[name];
			}
		}
	} else { /* Ancient browser..*/
		style = elem.style;
		for (var i=0; i<style.length; i++) {
			if(style[i] == style_name) {
				return style[style[i]];
			}
		}
	}
}

//send ajax request to save profile new edits
function saveProfileData(){

	// empty old list of errors
	$("#profile-save-status-msg").empty();

	var url = "/arts/public/profile/me/edit";

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
	   	url: '/arts/public/profile/me/edit',
	   	data: formData,
		type: 'POST',
	   	contentType: false,
		cache: false,
		processData:false,
	  	success: function(results) {
			// display new list of errors
	   		for (var i = 0; i < results.length; i++) {
	   			$("#profile-save-status-msg").append('<li>'+results[i]+'</li>')
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
		    $("#profile-save-status-msg").append("<li>failed to save</li>");
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

                document.getElementById('message').appendChild(newImg); 
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
$( "#submit-post" ).click(function() {

	if(validateImageUploader()){
		var postImageForm = document.getElementById('post-images-form');
	    var form = postImageForm;
	    var formdata = false;

	    if (window.FormData){
	        formdata = new FormData(postImageForm);
	    }

	    $.ajax({
	        url         : '/arts/public/post/new',
	        data        : formdata ? formdata : form.serialize(),
	        cache       : false,
	        contentType : false,
	        processData : false,
	        type        : 'POST',
	        success     : function(data, textStatus, jqXHR){
	            console.log(data);
	        },
	        errors		:  function() {
			    console.log('error');
			}
	    });
	}
	
});

function follow()
{
	//getting form data
	var form = document.getElementById('follow-form');
	var formData = new FormData(form);

	var userName = document.getElementById('profile-username-span').innerHTML;

	formData.append('userName', userName);

	$.ajax({
		url         : '/arts/public/follow',
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
		followers_list.style.visibility = "visible";
		following_list.style.visibility = "hidden";

	} else if (num == 1) {
		following_count_buttons[0].style.backgroundColor = "white";
		following_count_buttons[1].style.backgroundColor = "wheat";
	    followers_list.style.visibility = "hidden";
		following_list.style.visibility = "visible";
	}
}