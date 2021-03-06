function processInputData()
{
	//to get time and date from
	var currentdate = new Date(); 

	//getting input elements
	var title_element = document.getElementById('input-todo-title');
	var description_element = document.getElementById('input-todo-description');

	//setting data values and preventing xss injection
	input_title = (title_element.value).replace(/</g, "&lt;").replace(/>/g, "&gt;");;
	input_description = (description_element.value).replace(/</g, "&lt;").replace(/>/g, "&gt;");;
	date_time_added = "added: "+currentdate.toDateString()+ " " + currentdate.getHours()+":"+currentdate.getMinutes();

	if(checkInputDataValidity(input_title) && checkInputDataValidity(input_description)) {

		//add data to storage, get its id and add it to display
		var new_item_id = addNewToDoItemStorage(input_title, input_description, date_time_added)
		//acc to returned id - if it was <0 then there is an error
		if(new_item_id >= 0 ) {
			addNewToDoItemDisplay(new_item_id, input_title, input_description, date_time_added);
		}

		//clear inputs
		title_element.value = "";
		description_element.value =  "";
	} 
}

function checkInputDataValidity(input_data)
{	
	var error_msgs = ['input values cant be empty', 'input characters count must not exceed 200'];
	var passed_test = true;

	if(input_data == "" || input_data == null) {
		window.alert(error_msgs[0]);
		passed_test = false;
	} else if(input_data.length > 200) {
		window.alert(error_msgs[1]);
		passed_test = false;
	}

	return passed_test;
}

//retrieves all the todo item from storage and displays it
function displayTodoList() 
{
	//get stored items  from localStorage to loop over and get data to display it
	var stored_todo_list = 	getArrayOfStoredItems();
	
	//if empty storage - dont do any thing
	if(stored_todo_list) {
		for (var i = 0; i < stored_todo_list.length; i++) {
			var todo_item = stored_todo_list[i];
			addNewToDoItemDisplay(todo_item.id, todo_item.title, todo_item.description, todo_item.added_date);
		}
	}
}

function addNewToDoItemDisplay(new_item_id, input_title, input_description, date_time_added)
{
	//get list of diisplayed todo to add to it
	var todo_list = document.getElementById('display-todo-list');

	//create todo content
	var display_todo_title = document.createElement("h2");
	display_todo_title.innerHTML = input_title;

	var display_todo_datetime = document.createElement("h5");
	display_todo_datetime.innerHTML = date_time_added; 

	var display_todo_descritio = document.createElement("p");
	display_todo_descritio.innerHTML = input_description; 

	//create container of the todo and add data to it
	var display_todo_content = document.createElement("div");
	display_todo_content.className = "todo-content";

	display_todo_content.appendChild(display_todo_title);
	display_todo_content.appendChild(display_todo_datetime);
	display_todo_content.appendChild(display_todo_descritio);

	//create delete button and delete div
	var display_todo_deletebutton = document.createElement("input");
	display_todo_deletebutton.type = 'button';
	display_todo_deletebutton.value = 'X';
	display_todo_deletebutton.setAttribute('record-id', new_item_id);
	display_todo_deletebutton.className = "delete-button"
	display_todo_deletebutton.addEventListener("click",removeTodoItem);

	var display_todo_deletebox = document.createElement("div");
	display_todo_deletebox.className = "delete-one";

	display_todo_deletebox.appendChild(display_todo_deletebutton);

	//create clear div.
	var display_cleardiv = document.createElement("div");
	display_cleardiv.className = "clear";

	//create todo-box - append todocontent/delete/clear to it
	var display_todo_box = document.createElement("div");
	display_todo_box.className = "todo-boxes";

	display_todo_box.appendChild(display_todo_content);
	display_todo_box.appendChild(display_todo_deletebox);
	display_todo_box.appendChild(display_cleardiv);

	//insert new todo first in todo list
	todo_list.insertBefore(display_todo_box, todo_list.firstChild);
}

//stores new todo-item 
function addNewToDoItemStorage(input_title, input_description, date_time_added) 
{
	//create todo-item prototype
	function TodoItem(id, title, description, added_date) {
		this.id = id;
		this.title = title;
		this.description = description;
		this.added_date = added_date;
	}

	//get stored items to add to it - get last used id 
	var new_item_id = 0;
	var stored_todo_list = 	getArrayOfStoredItems();
	
	if(stored_todo_list && stored_todo_list[0] != null) {
		new_item_id = stored_todo_list[stored_todo_list.length - 1].id  + 1;
	}
	else {
		stored_todo_list = [];
	}
	
	//create new item object and added it to array
	var new_todo_item = new TodoItem(new_item_id, input_title, input_description, date_time_added);
	stored_todo_list.push(new_todo_item);

	//return -1 if return of storing was false or item_id if return was true
	var storingResult = storeTodoList(stored_todo_list);
	if(storingResult){
		return new_item_id;
	} else {
		return -1;
	}
}

//get from todolist as string from storage make it array and return
function getArrayOfStoredItems()
{
	return JSON.parse(localStorage.getItem("todo_list"));
}

//make the array string and store it in the storage
function storeTodoList(todo_list)
{
	var result = true;
	// limit 10 mb per domain
	try {
		localStorage.setItem("todo_list", JSON.stringify(todo_list));
	} catch (e) {
		if (isQuotaExceeded(e)) {
			result = false;
			window.alert("limit reached, no more is allowed");
		}
	} finally {
		return result;
	}
}
//check qoute exceeded for all browsers
function isQuotaExceeded(e) {
  var quotaExceeded = false;
  if (e) {
    if (e.code) {
      switch (e.code) {
        case 22:
          quotaExceeded = true;
          break;
        case 1014:
          // Firefox
          if (e.name === 'NS_ERROR_DOM_QUOTA_REACHED') {
            quotaExceeded = true;
          }
          break;
      }
    } else if (e.number === -2147024882) {
      // Internet Explorer 8
      quotaExceeded = true;
    }
  }
  return quotaExceeded;
}
//deletes a todo-item
function removeTodoItem() 
{
	var confirmed = confirm("Are you sure!");

	if(confirmed) {

		/*get stored items  from localStorage to loop over and 
		get all that dont have the id to delete*/
		var stored_todo_list = 	getArrayOfStoredItems();
		var new_todo_list = [];

		for (var i = 0; i < stored_todo_list.length; i++) {
			var todo_item = stored_todo_list[i];
			if(todo_item.id != this.getAttribute('record-id')) {
				new_todo_list.push(todo_item);
			}
		}

		storeTodoList(new_todo_list);

		//get list of displayed todo to add to it
		var todo_list = document.getElementById('display-todo-list');

		//getting the todo-box and its parent 
		var deleteDiv = this.parentElement;
		var todo_box = deleteDiv.parentElement;
		todo_box.parentElement.removeChild(todo_box);
	}
}

//function check if storage is available
function storageAvailable(type) {
	try {
		var storage = window[type],
			x = '__storage_test__';
		storage.setItem(x, x);
		storage.removeItem(x);
		return true;
	}
	catch(e) {
		return false;
	}
}

//check if browser supports html5 storage
if (storageAvailable('localStorage')) {
	displayTodoList();
}
else {	
	document.getElementById('container').innerHTML = 'Cant serve you, try to upgrade or change your browser';
}