/** 
 * Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: scheduler.js is the JavaScript file for controling group scheduler web application.
 */

/**
 * execute function when the page has loaded
 * @param  {load} "load" event
 * @param  {function} function works when the event occur
 */
window.addEventListener("load", function() {

    displaySchedule();

    let addbutton = document.getElementById("clickme");

    /**
     * execute function to make a schedule list and add it in the html code  
     * @param  {schedule}  schedule in the schedule list
     */
    function scheduleToHtml(schedule) {
        let html = "";
        html += "<tr id='id" + schedule.id +"'><td>" + schedule.date + "</td><td>" + schedule.title + "</td><td>" + schedule.text + "</td><td>" + schedule.username + "</td></tr>";
        return html;
    }

    /**
     * execute function to make a user's own schedule list and add it in the html code  
     * @param  {schedule}  schedule in the user's schedule list
     */
    function itemToHtml(schedule) {
        let html = "";
        html += "<tr id='id" + schedule.id +"'><td>" + schedule.date + "</td><td>" + schedule.title + "</td><td>" + schedule.text + "</td><td><button class='delete'>❌</button></td><td><button class='edit'>Edit</button></td></tr>";
        return html;
    }
    
    /**
     * execute function to display the group schedule on the screen  
     */
    function displaySchedule() {
        displayMySchedule();

        let url = "getallschedule.php";

        // do the fetch
        fetch(url, { credentials: 'include' })
            .then(response => response.json())
            .then(schedulelist)
    }

    /**
     * execute function to display the user's schedule on the screen  
     */
    function displayMySchedule() {
        let userNumber = parseInt(document.getElementById("user").innerText);
        
        let url = "getmyschedule.php?useridparam="+userid.value;

        // do the fetch
        fetch(url, { credentials: 'include' })
            .then(response => response.json())
            .then(mySchedulelist)
    }

    
    /**
     * execute function to set the eventhandler and change the data in the schedulelist according to the user's choice 
     * @param  {list} schedulelist
     */
    function schedulelist(list){

        let schedules = "<tr><td>Date</td><td>Title</td><td>Text</td><td>User Name</td></tr>"

        for (let i = 0; i < list.length; i++) {
            schedules += scheduleToHtml(list[i]);
        }
        document.getElementById("schedules").innerHTML = schedules;

        editCheck();
    }

    /**
     * execute function to set the eventhandler and change the data in the user's schedulelist according to the user's choice 
     * @param  {list} schedulelist
     */
    function mySchedulelist(list){

        let items =  "<table><tr><td>Date</td><td>Title</td><td>Text</td><td>Delete</td><td>Edit</td></tr>";
        for (let i = 0; i < list.length; i++) {
            items += itemToHtml(list[i]);
        }
        items += "</table>"; 
        document.getElementById("list").innerHTML = items;


        let deletebuttons = document.querySelectorAll(".delete")
        let id;

        for (let i = 0; i < deletebuttons.length; i++) {
            deletebuttons[i].addEventListener("click", function() {
                id = deletebuttons[i].parentNode.parentNode.id;

                deleteProcess(id);
            });
        }

        editCheck();
    }


    /**
    * execute function when the user click the 'add' button on the screen  
    * @param  {click} "click" event
     */
    addbutton.addEventListener("click", function() {

        let url = "addschedule.php?idparam=" + userid.value +"&dateparam=" + date.value + "&titleparam="+ title1.value + "&textparam=" + text.value;

        // do the fetch
        fetch(url, { credentials: 'include' })
            .then(response => response.text())
            .then(displaySchedule)
    });


    /**
    * execute function to fetch the url and get the database result using id for deleting 
    * @param  {id} schedule id
    */
    function deleteProcess(id){


        id = id.substring(2);
        let url = "deleteschedule.php?id="+id;


        fetch(url, { credentials: 'include' })
        .then(response => response.text())
        .then(displaySchedule);
    }

    /**
    * execute function to fetch the url and get the database result using id for updating 
    * @param  {id} schedule id
    */    
    function editProcess(id){

        let newTitle = document.getElementById("newTitle").value.trim();
        let newText = document.getElementById("newText").value;

        if(newTitle==""){
            newTitle = document.getElementById(id).childNodes[1].innerText;
        } 

        if(newText==""){
            newText = document.getElementById(id).childNodes[2].innerText;
        } 

        id = id.substring(2);

        let url = "updateschedule.php?id="+id+"&title="+newTitle+"&text="+newText;

        fetch(url, { credentials: 'include' })
        .then(response => response.text())
        .then(displaySchedule);
    }

    /**
     * execute function to check the changed schedule information and add it in the html code 
     */
    function editCheck(){
        let editbuttons = document.querySelectorAll(".edit");
        for (let i = 0; i < editbuttons.length; i++) {
            editbuttons[i].addEventListener("click", function(event) {

               event.target.parentNode.innerHTML = "<div id='editInput'><input type='text' id='newTitle' placeholder='Change Title' /><input type='text' id='newText'  placeholder='Change Text'/><input type='submit' id='change' value='change'/><input type='submit' id='cancle' value='cancle'/></div>";


            document.getElementById("change").addEventListener("click", function(event) {
                id = event.target.parentNode.parentNode.parentNode.id;

                editProcess(id);
                });

            document.getElementById("cancle").addEventListener("click", function() {
                displaySchedule();
                    });

            });
        }
    }

});