<!-- 
//comment tag to "hide" scripts from browsers without support

//this function intialize the disks in the source tower
function drawDisks() {
	var disk_number = 8
	var colors = ['#006495','pink','#0093D1','#F2635F','#F4D00C','#E0A025','#004C70','violet'];

	while(disk_number >0) {
		//setting width-height of disk acc to its number,width 1.5 times height
		var height = disk_number * 12;
		var width = disk_number * 18;

		//creating the new disk and insert it before first element in src tower
		var new_disk = document.createElement('div');
		var source_tower = document.getElementById("tower-source");
		var srctower_first_child = source_tower.firstChild;

		//setting disk id, class, shape/color/place properties
		new_disk.setAttribute("class", "oval");
		new_disk.setAttribute("id", "disk"+disk_number);
		new_disk.setAttribute("style", "background-color:"+colors.pop()+
								" ; width: "+width+"px; "+ "height: "+height+"px; z-index:"+
								(8-disk_number)+"; left:"+7*(8-disk_number)+"px; bottom:"+
								calculateBottom(srctower_first_child)+";");

		source_tower.insertBefore(new_disk, srctower_first_child);

		disk_number--;
	}
}

var interval = 0;
function hanoi (disc, source, temp, destination) {

	if (disc > 0) {
		
		hanoi(disc - 1, source, destination, temp);

		//moving disk from one place to another
		var status = 'Move disc ' + disc + ' from ' + source + ' to ' + destination;

		setTimeout(function() {changeDiskPlace(disc, destination);PrintNewStatus(status); }, interval)
		interval+=500;

		hanoi(disc - 1, temp, source, destination);
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

function changeDiskPlace(disc, destination)
{
	/**
	*get the disk using id name ex: disk1 
	*get destination tower
	*get first child of destination to use its height and bottom to push disk before
	*/

	var disk_display = document.getElementById("disk"+disc);
	var destination_display = document.getElementById(destination);
	var first_child = destination_display.firstChild;
	
	disk_display.style.bottom = calculateBottom(first_child);

	destination_display.insertBefore(disk_display, destination_display.firstChild);
}

function calculateBottom(first_child)
{
	var bottom;

	if(first_child)
	bottom = (parseInt(first_child.style.height.replace(/px/,""))/2 + parseInt(first_child.style.bottom.replace(/px/,"")) )+ "px";
	else
		bottom = '5px';

	return bottom;
}

function getStatusBox()
{
	//put status box & hide start button
	status_box = document.getElementById('status-box');
	status_box.style.display = "block";

	start_buttom = document.getElementById('start-button');
	start_buttom.style.display = "none";
}

function startGame()
{
	getStatusBox();

	hanoi(8, 'tower-source', 'tower-temporary', 'tower-destination');
}

drawDisks();

//-->