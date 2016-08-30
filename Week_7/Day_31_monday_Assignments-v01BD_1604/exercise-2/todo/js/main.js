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

	//get list of todo to add to it
	var todo_list = document.getElementById('display-todo-list');

	//add data to the display
	addNewToDoDisplay(todo_list, input_title, input_description, date_time_added);
	
	//clear inputs
	title_element.value = "";
	description_element.value =  "";
}

function addNewToDoDisplay(todo_list, input_title, input_description, date_time_added)
{
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
	display_todo_deletebutton.className = "delete-button"
	display_todo_deletebutton.addEventListener("click",removeTodo);

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

function removeTodo() 
{
	var confirmed = confirm("Are you sure!");

	if(confirmed) {
		//getting the todo-box and its parent 
		var deleteDiv = this.parentElement;
		var todo_box = deleteDiv.parentElement;
		todo_box.parentElement.removeChild(todo_box);
	}
	
}