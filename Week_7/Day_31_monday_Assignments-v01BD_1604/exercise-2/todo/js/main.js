function getInputData()
{
	//to get time and date from
	var currentdate = new Date(); 

	//getting input elements
	var title_element = document.getElementById('input-todo-title');
	var description_element = document.getElementById('input-todo-description');

	//setting data values
	input_title = title_element.value;
	input_description = description_element.value;
	date_time_added = "added: "+currentdate.toDateString()+ " " + currentdate.toTimeString();

	//add data to storage, get its id and add it to display
	var new_item_id = addNewToDoItemStorage(input_title, input_description, date_time_added) 
	addNewToDoItemDisplay(new_item_id, input_title, input_description, date_time_added);
	
	//clear inputs
	title_element.value = "";
	description_element.value =  "";
}

//retrieves all the todo item from storage and displays it
function displayTodoList() 
{
	//get stored items  from localStorage to loop over and get data to display it
	var stored_todo_list = 	getArrayOfStoredItems();

	for (var i = 0; i < stored_todo_list.length; i++) {
		var todo_item = stored_todo_list[i];
		addNewToDoItemDisplay(todo_item.id, todo_item.title, todo_item.description, todo_item.added_date);
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
	display_todo_deletebutton.name = new_item_id;
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
	if(!stored_todo_list) {
		new_item_id = stored_todo_list[stored_todo_list.length - 1].id  + 1;
	}
	
	//create new item object and added it to array
	var new_todo_item = new TodoItem(new_item_id, input_title, input_description, date_time_added);
	stored_todo_list.push(new_todo_item);

	storeTodoList(stored_todo_list);

	//returns todo-item id to use it for delete
	return new_item_id;
}

//get from todolist as string from storage make it array and return
function getArrayOfStoredItems()
{
	return JSON.parse(localStorage.getItem("todo_list"));
}

//make the array string and store it in the storage
function storeTodoList(todo_list)
{
	localStorage.setItem("todo_list", JSON.stringify(todo_list));
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
			if(todo_item.id != this.name) {
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


if (storageAvailable('localStorage')) {
	displayTodoList();
}
else {	
	document.write('Cant serve you, try to upgrade or change your browser');
}