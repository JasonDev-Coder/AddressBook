window.addEventListener("load", (event) => {
  displayRows();//when the page loads fill the body with the organizations
  loadModalForm();//load the modal form by providing listeners
  loadSubmitAction();//load the submit form by providing listeners
});
//a function to save up code by specifying the path of the script needed and any variable used
function AjaxRequest(functionPath, variable = "") {
  var request = new XMLHttpRequest();//create an XMLHttpRequest
  request.onreadystatechange = function () {
    if (request.readyState == 4) {//operation done
      if (request.status == 200) {//OK status from server
        document.getElementById("persons_table_body").innerHTML =
          request.responseText;//fill the body of the table with the returned tags from the controller
      } else alert("ERROR Request Status=" + request.status);
    }
  };
  request.open("GET", functionPath + variable);
  request.send(null);
}
//use ajax to display rows of the person table
function displayRows() {
  AjaxRequest("/AddressBook/public/PersonController/getPersonsForOrganization");//path of script to select all rows
}
//function that uses ajax to delete a person row providing script location and id of the person
function deletePerson(person_id) {
  AjaxRequest(
    "/AddressBook/public/PersonController/deletePersonByID/",
    person_id
  );
}
//function that uses ajax to edit  person, whenevre we want to edit a person the modal form will popup and we will provde its information in the fields so that we can modify upon them
function editPerson(person_id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        json_data = JSON.parse(request.responseText);//parse the encoded json returned from the controller and fill the fields with the information
        openFormEdit(person_id);
        document.getElementById("personName").value = json_data.first_name;
        document.getElementById("personLastName").value = json_data.last_name;
        document.getElementById("personNum").value = json_data.phone_number;
        document.getElementById("personEmail").value = json_data.email;
        document.getElementById("personDOB").value = json_data.date_of_birth;
        document.getElementById("personAddress").value = json_data.address;
      } else alert("ERROR Request Status=" + request.status);
    }
  };
  request.open(
    "GET",
    "/AddressBook/public/PersonController/getPersonByID/" + person_id
  );
  request.send(null);
}
//function that opens the modal form to edit, whenever we want to edit the form action script must be changed to the updatePerson function of the controller
function openFormEdit(id) {
  document.getElementsByTagName("form")[0].action =
    "/AddressBook/public/PersonController/updatePerson/" + id;//change form action function

  document.getElementById("myModal").style.display = "block";//display the modal
}
function loadModalForm() {
  //get the form
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("add-person");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal and change action of form to addPerson to insert a new person
  btn.onclick = function () {
    document.getElementsByTagName("form")[0].action =
      "/AddressBook/public/PersonController/addPerson";
    //reset the fields to empty in case we pressed on edit before and the fields were filled
    document.getElementById("personName").value = "";
    document.getElementById("personLastName").value = "";
    document.getElementById("personNum").value = "";
    document.getElementById("personEmail").value = "";
    document.getElementById("personDOB").value = "";
    document.getElementById("personAddress").value = "";
    document.getElementById("myForm").style.display = "block";
    modal.style.display = "block";
  };

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  };

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}
function loadSubmitAction() {
  $("form").submit(function (event) {
    event.preventDefault();//prevent default submission from the browser
 //get the form data and store an array
    var formData = {
      first_name: $("input[name=person_Fname]").val(),
      last_name: $("input[name=person_Lname]").val(),
      phone_number: $("input[name=person_phoneNumber]").val(),
      date_of_birth: $("input[name=person_dob]").val(),
      email: $("input[name=person_email]").val(),
      address: $("#personAddress").val(),
    };
    var form = $(this);
    var form_url = form.attr("action");//get the form action(which can be action of create person or edit person)
    // process the form
    $.ajax({
      type: "POST", // define the type of HTTP to use
      url: form_url, // the url where we want to POST
      data: formData, // our data object
    })
      // done callback
      .done(function (data) {
        
        document.getElementById("persons_table_body").innerHTML = data;//display data in body of table provided by the server
        document.getElementById("myModal").style.display="none";//close the modal
        window.alert("Success");//alert a success message
      })
      .fail(function (data) {
        //Server failed to respond - Show an error message
        alert("FAIL" + data);
      });
  });
}
