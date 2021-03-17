<?php
class OrganizationController extends Controller
{
    //we will be fetching data using 2 models Organization model and Person model
    private $OrganizationModel = NULL;
    private $PersonModel = NULL;
    public function __construct()//initiate the 2 models to be used
    {
        $this->OrganizationModel = $this->model('OrganizationModel');
        $this->PersonModel = $this->model('PersonModel');
    }
    //function to add an organization to the Organization Table
    public function addOrganization($name, $email, $phone_number, $location)
    {
        if (isset($name) && isset($email) && isset($phone_number) && isset($location)) {
            //htmlspecialchars used on input parameters to prevent an attack vector
            $name = htmlspecialchars($name);
            $email = htmlspecialchars($email);
            $phone_number = htmlspecialchars($phone_number);
            $location = htmlspecialchars($location);
            //real escape string used on all inputs to prevent certain attacks
            $name = $this->OrganizationModel->connect()->real_escape_string($name);
            $email = $this->OrganizationModel->connect()->real_escape_string($email);
            $phone_number = $this->OrganizationModel->connect()->real_escape_string($phone_number);
            $location = $this->OrganizationModel->connect()->real_escape_string($location);
            //execute the insert query from our Organization Model(returns true or false)
            $result = $this->OrganizationModel->insertOrganization($name, $email, $phone_number, $location);
            if ($result) {
                $organizationTable = $this->getAllOrganizationsTable();
                return $organizationTable;
            } else return NULL;
        }
    }
    //function to create a table body out of all organizations in out database
    public function getAllOrganizationsTable()
    {
        //run the SELECT * sql command from our model 
        $organizationRows = $this->OrganizationModel->SelectAll();
        $table_body_data = "";
        while ($row = $organizationRows->fetch_assoc()) {
            //create a table body to return it to our table 
            $peopleCount=$this->PersonModel->getNumberOfPersonsForOrganization($row['organization_id'])->fetch_array();//get number of persons for a given organization
            $table_body_data .= "<tr><td>" . $row["organization_id"] . "</td><td>" . $row["organization_name"] . "</td><td>" . $row["organization_email"] . "</td><td>" . $row["organization_phone_number"] . "</td><td>" . $row["organization_location"] . "</td><td>" . $peopleCount[0] . "</td><td>" . '<div class=btnWrapper><button class=action_container_delete onclick=deleteOrganization(' . $row["organization_id"] . ') value=' . $row["organization_id"] . '>
            Delete
            </button> 
            <button onclick=editOrganization(' . $row["organization_id"] . '); class=action_container_edit value=' . $row["organization_id"] . '>
            Edit
            </button> 
            <a href=/AddressBook/public/OrganizationController/goToContacts/'.$row["organization_id"].'><button class=action_container_edit value=' . $row["organization_id"] . '>
            View Contacts
            </button></a></div>' . "</td></tr>";
        }
        return $table_body_data;
    }
    //function to delete an organization given an Organization ID
    public function deleteOrganizationByID($organization_id)
    {   //run the DELETE query from our model(returns true or false)
        $result = $this->OrganizationModel->deleteOrganization($organization_id);
        if ($result) {
            $table_body_data = $this->getAllOrganizationsTable();//return an updated table body
            return $table_body_data;
        } else return NULL;
    }
    //function to select an organization given an Organization ID
    public function getOrganizationByID($organization_id)
    {   //run the SELECT query from our model
        $organizationRows = $this->OrganizationModel->SelectOrganization($organization_id);
        if ($organizationRows->num_rows!=0) {
           return json_encode($organizationRows->fetch_assoc());//return result as json
        } else return NULL;
    }
    //function to update fields of an Organization
    public function updateOrganization($id,$name,$email,$phone_number,$location){
        //run the UPDATE query from our model
        $result=$this->OrganizationModel->updateOrganization($id,$name,$email,$phone_number,$location);
        if($result){
            $organizationTable = $this->getAllOrganizationsTable();//return an updated table body
            return $organizationTable;
        }else return NULL;
    }
    //navigate to contacts page with a given ORganization ID that will be stored in SESSION global variable in order to identify which persons are related to this company(this id is the foreign key for person)
    public function goToContacts($id){
        $_SESSION["organization_id"]=$id;
        $this->view('contacts');
    }
    //default function to be used in our routing 
    public function index()
    {
        $this->view('organizations');
    }
}
?>
