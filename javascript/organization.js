window.addEventListener("load", (event) => {
  displayRows();//when the page loads fill the body with the organizations
  loadModalForm();//load the modal form by providing listeners
  loadSubmitAction();//load the submit form by providing listeners
});
//a function to save up code by specifying the path of the script needed and any variable used
function AjaxRequest(functionPath, variable = "") {
  var request = new XMLHttpRequest(); //create an XMLHttpRequest
  request.onreadystatechange = function () {
    if (request.readyState == 4) {//operation done
      if (request.status == 200) {//OK status from server
        document.getElementById("organization_table_body").innerHTML =
          request.responseText;//fill the body of the table with the returned tags from the controller
      } else alert("ERROR Request Status=" + request.status);
    }
  };
  request.open("GET", functionPath + variable);
  request.send(null);
}
//use ajax to display rows of the organiazation table
function displayRows() {
  AjaxRequest(
    "/AddressBook/public/OrganizationController/getAllOrganizationsTable"//path of script to select all rows
  );
}
//function that uses ajax to delete an organization row providing script location and id of organization
function deleteOrganization(id) {
  AjaxRequest(
    "/AddressBook/public/OrganizationController/deleteOrganizationByID/",
    id
  );
}
//function that uses ajax to edit an organization, whenevre we want to edit an organization the modal form will popup and we will provde its information in the fields so that we can modify upon them
function editOrganization(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        json_data = JSON.parse(request.responseText);//parse the encoded json returned from the controller and fill the fields with the information
        openFormEdit(id);
        document.getElementById("orgName").value = json_data.organization_name;
        document.getElementById("orgEmail").value =
          json_data.organization_email;
        document.getElementById("orgNum").value =
          json_data.organization_phone_number;
        document.getElementById("orgLoc").value =
          json_data.organization_location;
      } else alert("ERROR Request Status=" + request.status);
    }
  };
  request.open(
    "GET",
    "/AddressBook/public/OrganizationController/getOrganizationByID/" + id
  );
  request.send(null);
}
//function that opens the modal form to edit, whenever we want to edit the form action script must be changed to the updateOrganization function of the controller
function openFormEdit(id) {
  document.getElementsByTagName("form")[0].action =
    "/AddressBook/public/OrganizationController/updateOrganization/" + id;//change form action function
  //display the modal form
  document.getElementById("myModal").style.display = "block";
}

function loadModalForm() {
  //get the form object
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal for creating an organization
  var btn = document.getElementById("add-organization");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal and change action of form to addOrganization to insert a new organization
  btn.onclick = function () {
    document.getElementsByTagName("form")[0].action =
      "/AddressBook/public/OrganizationController/addOrganization";
    //reset the fields to empty in case we pressed on edit before and the fields were filled
    document.getElementById("orgName").value = "";
    document.getElementById("orgEmail").value = "";
    document.getElementById("orgNum").value = "";
    document.getElementById("orgLoc").value = "";
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
      organization_name: $("input[name=organization_name]").val(),
      organization_email: $("input[name=organization_email]").val(),
      organization_phone_number: $(
        "input[name=organization_phoneNumber]"
      ).val(),
      organization_location: $("#orgLoc").val(),
    };
    var form = $(this);
    var form_url = form.attr("action");//get the form action(which can be action of create organization or edit organization)
    // process the form
    $.ajax({
      type: "POST", // define the type of HTTP verb we want to use
      url: form_url, // the url where we want to POST
      data: formData, // our data object
    })
      // done callback
      .done(function (data) {
        //use the echoed data from the server to insert it into the table body
        document.getElementById("organization_table_body").innerHTML = data;
        document.getElementById("myModal").style.display="none";//close the modal after submission and alert a success message
        window.alert("Success");
      })
      .fail(function (data) {
        //Server fails to respond we alert an error message
        alert("FAIL" + data);
      });
  });
}
