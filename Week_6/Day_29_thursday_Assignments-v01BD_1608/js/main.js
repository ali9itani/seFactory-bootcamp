<!-- 
//comment tag to "hide" scripts from browsers without support

hanoi(8, 'source-tower', 'temporary-tower', 'destination-tower');

function hanoi (disc, source, temp, destination) {  
	if (disc > 0) {
	   hanoi(disc - 1, source, destination, temp);
	   var status = 'Move disc ' + disc + ' from ' + source + ' to ' + destination;
 	   PrintNewStatus(status);
	   hanoi(disc - 1, temp, source, destination);
 	}
}
function PrintNewStatus(status) {
    var new_paragraph = document.createElement('p');
    new_paragraph.textContent = status;
    var status_box = document.getElementById("status-box");
    status_box.insertBefore(new_paragraph, status_box.firstChild);
}
function redrawDisk() {

}
//-->