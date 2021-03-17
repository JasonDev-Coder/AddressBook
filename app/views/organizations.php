<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizations</title>
    <!-- links to css files-->
    <link rel="stylesheet" href="../../css/table.css" />
    <link rel="stylesheet" href="../../css/organization.css" />
    <link rel="stylesheet" href="../../css/modalForm.css" />
    <!--javascript link to my organization page javascript-->
    <script type="text/javascript" language="javascript" src="../../javascript/organization.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--jQuery link-->
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
    <button id="add-organization">Add Organization</button>
    <div id="myModal" class="modal">
        <!-- Modal content popup form -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="form-popup" id="myForm">
                <form id=createOrg class="form-container">
                    <label><b>Organization Name</b></label>
                    <!-- class names are for bootstrap-->
                    <input class="form-control form-control-sm" id="orgName" type="text" placeholder="Enter Name" name="organization_name" required><br>

                    <label><b>Organization Email</b></label>
                    <input class="form-control form-control-sm" id="orgEmail" type="email" placeholder="Enter Email" name="organization_email" required><br>

                    <label><b>Phone Number</b></label>
                    <input class="form-control form-control-sm" id="orgNum" type="tel" placeholder="+xxx-xxxxxxxx" name="organization_phoneNumber" pattern="\+[0-9]{3}-[0-9]{8}" required><br>

                    <label><b>Location</b></label>
                    <textarea class="form-control form-control-sm" id="orgLoc" type="text" placeholder="Enter Location" name="organization_location" required></textarea><br>

                    <input type="submit" class="btn btn-primary mb-2" value="Submit" />
                </form>
            </div>
        </div>

    </div>
    <div class="table_container">
        <table id="organizations_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>Number of People</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!--table body where html tags are provided from the controller with the information-->
            <tbody id="organization_table_body"></tbody>
        </table>
    </div>
</body>

</html>