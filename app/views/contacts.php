<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persons</title>
    <!-- links to css files-->
    <link rel="stylesheet" href="../../css/table.css" />
    <link rel="stylesheet" href="../../css/person.css" />
    <link rel="stylesheet" href="../../css/modalForm.css" />
    <!--javascript link to my person page javascript-->
    <script type="text/javascript" language="javascript" src="../../javascript/person.js"></script>
    <!--jQuery link-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- bootstrap links-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php
    require_once 'header.html';
    ?>
    <button id="add-person">Add Person</button>
    <div id="myModal" class="modal">
        <!-- Modal content popup form to submit or edit a person -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="form-popup" id="myForm">
                <form id=createPerson class="form-container">
                    <label><b>First Name</b></label>
                    <!-- class names are for bootstrap -->
                    <input class="form-control form-control-sm" id="personName" type="text" placeholder="Enter Name" name="person_Fname" required><br>

                    <label><b>Last Name</b></label>
                    <input class="form-control form-control-sm" id="personLastName" type="text" placeholder="Enter Name" name="person_Lname" required><br>

                    <label><b>Phone Number</b></label>
                    <input class="form-control form-control-sm" id="personNum" type="tel" placeholder="Enter Phone Number" name="person_phoneNumber" pattern="\+[0-9]{3}-[0-9]{8}" required><br>

                    <label><b>Date of Birth</b></label>
                    <input class="form-control form-control-sm" id="personDOB" type="date" placeholder="Enter Birthdate" name="person_dob" required><br>

                    <label><b>Email</b></label>
                    <input class="form-control form-control-sm" id="personEmail" type="email" placeholder="+xxx-xxxxxxxx" name="person_email" required><br>


                    <label><b>Address</b></label>
                    <textarea class="form-control form-control-sm" id="personAddress" type="text" placeholder="Enter Address" name="person_address" row=3 required></textarea><br>

                    <input type="submit" class="btn btn-primary mb-2" value="Submit" />
                </form>
            </div>
        </div>
    </div>

    <div class="table_container">
        <table id="persons_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Date of birth</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!-- table body where the html tags will be provided from controllers-->
            <tbody id="persons_table_body"></tbody>
        </table>
    </div>
</body>

</html>