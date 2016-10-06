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