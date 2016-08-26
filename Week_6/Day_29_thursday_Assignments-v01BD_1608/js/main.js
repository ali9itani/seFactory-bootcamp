<!-- 
//comment tag to "hide" scripts from browsers without support
drawDisks();

hanoi(8, 'tower-source', 'tower-temporary', 'tower-destination');


var source_tower = 0;
var temporary_tower = 0;
var destination_tower = 0;

function drawDisks() {
	var disk_number = 1;

	while(disk_number < 9) {
		

		var height = disk_number * 10;
		var width = disk_number * 15;

		var new_disk = document.createElement('div');
		new_disk.setAttribute("class", "oval");
		new_disk.setAttribute("id", "disk"+disk_number);
		new_disk.setAttribute("style", "width: "+width+"px ;" + "height: "+height+"px ; z-index:"+(8-disk_number)+"; left:"+5*(8-disk_number)+"px;top:"+(((5*(disk_number+5))*(8-disk_number)))+"px ;");

	    var source_tower = document.getElementById("tower-source");
	    source_tower.appendChild(new_disk);

	    disk_number++;
	}

}
function hanoi (disc, source, temp, destination) {  
	if (disc > 0) {
	   hanoi(disc - 1, source, destination, temp);

	   //moving disk from one place to another
	   var status = 'Move disc ' + disc + ' from ' + source + ' to ' + destination;


	   changeDiskPlace(disc, destination);
	   
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
function changeDiskPlace(disc, destination) {
 	   var disk_display = document.getElementById("disk"+disc);
 	   var destination_display = document.getElementById(destination);
	   destination_display.insertBefore(disk_display, destination_display.firstChild);

}
//-->