<!-- 
//comment tag to "hide" scripts from browsers without support

function drawDisks() {
	var disk_number = 1;

	while(disk_number < 9) {
		//setting width-height of disk acc to its number
		var height = disk_number * 10;
		var width = disk_number * 15;

		//creating the disk and placing it above the larger disks
		var new_disk = document.createElement('div');
		new_disk.setAttribute("class", "oval");
		new_disk.setAttribute("id", "disk"+disk_number);
		new_disk.setAttribute("style", "width: "+width+"px ;" + "height: "+height+"px ; z-index:"+(8-disk_number)+"; left:"+7*(8-disk_number)+"px;bottom:"+20*(8-disk_number)+"px ;");

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
		//hanoi(disc - 1, temp, source, destination);
		setTimeout(function() {hanoi(disc - 1, temp, source, destination); }, 1000)
	}
}

function PrintNewStatus(status) {
	//creating new paragraph
	var new_paragraph = document.createElement('p');
	new_paragraph.textContent = status;

	//adding it as first element in status box
	var status_box = document.getElementById("status-box");
	status_box.insertBefore(new_paragraph, status_box.firstChild);
}

function changeDiskPlace(disc, destination) {
	//get the disk using id name ex: disk1
	var disk_display = document.getElementById("disk"+disc);

	//adding it as first element in its new destinantion
	var destination_display = document.getElementById(destination);
	destination_display.insertBefore(disk_display, destination_display.firstChild);
}

function startGame(){
	hanoi(8, 'tower-source', 'tower-temporary', 'tower-destination');
}

drawDisks();

//-->