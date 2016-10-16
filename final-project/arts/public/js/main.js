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
				var  imgId = $("#profile-img").attr("user-data-img-id"); 
				
				var newDate = new Date();
				$("#profile-img").attr("src", '../../img/profile-photo/'+
								  imgId+'.jpg?'+newDate.getTime());

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


// var postImageForm = document.getElementById('post-images-form');

// postImageForm.addEventListener('submit', function(e){
// 	e.preventDefault();

//     var form = postImageForm;
//     var formdata = false;
//     if (window.FormData){
//         formdata = new FormData(postImageForm);
//     }

//     $.ajax({
//         url         : '/arts/public/post/new',
//         data        : formdata ? formdata : form.serialize(),
//         cache       : false,
//         contentType : false,
//         processData : false,
//         type        : 'POST',
//         success     : function(data, textStatus, jqXHR){
//             console.log(data);
//         },
//         errors		:  function() {
// 		    console.log('error');
// 		}
//     });
// });

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