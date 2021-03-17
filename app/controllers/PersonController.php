<?php
class PersonController extends Controller
{
    private $PersonModel = NULL;//Person model to be use dto fetch data from the database
    public function __construct()//initiate the model
    {
        $this->PersonModel = $this->model('PersonModel');
    }
    //function to add a person to our database
    public function addPerson($first_name, $last_name, $phone_number, $date_of_birth, $email, $address)
    {   
        $organization_id = $_SESSION["organization_id"];//foreign key extracted from the session gloabl variable to be used to know for which roganization are we inserting the person
        if (isset($organization_id) && isset($first_name) && isset($last_name) && isset($email) && isset($phone_number) && isset($date_of_birth) && isset($address)) {
            //htmlspecialchars used on input parameters to prevent an attack vector
            $organization_id = htmlspecialchars($organization_id);
            $first_name = htmlspecialchars($first_name);
            $last_name = htmlspecialchars($last_name);
            $email = htmlspecialchars($email);
            $phone_number = htmlspecialchars($phone_number);
            $date_of_birth = htmlspecialchars($date_of_birth);
            $address = htmlspecialchars($address);
            //real escape string used on all inputs to prevent certain attacks
            $organization_id = $this->PersonModel->connect()->real_escape_string($organization_id);
            $first_name =  $this->PersonModel->connect()->real_escape_string($first_name);
            $last_name =  $this->PersonModel->connect()->real_escape_string($last_name);
            $email =  $this->PersonModel->connect()->real_escape_string($email);
            $phone_number =  $this->PersonModel->connect()->real_escape_string($phone_number);
            $date_of_birth =  $this->PersonModel->connect()->real_escape_string($date_of_birth);
            $address = $this->PersonModel->connect()->real_escape_string($address);

            $timestamp = strtotime($date_of_birth);
            $mysqldate =  date("Y-m-d", $timestamp);//format the date to MySQL supported date
            //run the insert sql statement from our model (returns true or false)
            $result = $this->PersonModel->insertPerson($organization_id, $first_name, $last_name, $phone_number, $mysqldate, $email, $address);
            if ($result) {
                $personTable = $this->getPersonsForOrganization();//return an updated table
                return $personTable;
            } else return NULL;
        }
    }
    //function to select persons depending on the organization thats why we use organization id as our foreign key
    public function getPersonsForOrganization()
    {
        $organization_id = $_SESSION["organization_id"];//organization id foreign key to retrieve people from the organization we selected
        $personsRows = $this->PersonModel->SelectPersonFromOrganization($organization_id);//retrieve the rows
        $table_body_data = "";
        while ($row = $personsRows->fetch_assoc()) {
            //create a table body 
            $table_body_data .= "<tr><td>" . $row["person_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["email"] . "</td><td>" . $row["date_of_birth"] . "</td><td>" . $row["address"] . "</td><td>" . '<button class=action_container_delete onclick=deletePerson(' . $row["person_id"] . ') value=' . $row["person_id"] . '>
            Delete
            </button> 
            <button onclick=editPerson(' . $row["person_id"] . '); class=action_container_edit value=' . $row["person_id"] . '>
            Edit
            </button> ' . "</td></tr>";
        }
        return $table_body_data;
    }
    //function to delete a person depending on the person id
    public function deletePersonByID($person_id)
    {   //run the DELETE query from our model
        $result = $this->PersonModel->deletePerson($person_id);
        if ($result) {
            $table_body_data = $this->getPersonsForOrganization();//return an updated table
            return $table_body_data;
        } else return NULL;
    }
    //function to select a person by his id
    public function getPersonByID($person_id)
    {   //run the select query from our model(1 row only should be returned)
        $PersonRow = $this->PersonModel->SelectPersonById($person_id);
        if ($PersonRow->num_rows != 0) {
            return json_encode($PersonRow->fetch_assoc());//return information as json
        } else return NULL;
    }
    //function to update the person information given his id
    public function updatePerson($person_id, $first_name, $last_name, $phone_number, $date_of_birth, $email, $address)
    {   //run the UPDATE query from our model
        $result = $this->PersonModel->updatePerson($person_id, $first_name, $last_name, $phone_number, $date_of_birth, $email, $address);
        if ($result) {
            $personTable = $this->getPersonsForOrganization();//return an updated table
            return $personTable;
        } else return NULL;
    }
}
?>