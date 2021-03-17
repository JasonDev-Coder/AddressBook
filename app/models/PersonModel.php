<?php
require_once 'Dbh.php';
//Person Model class that extends the Dbh class to connect to the database and execute queries
class PersonModel extends Dbh{
    //function that executes INSERT query to insert a new person row
    public function insertPerson($organization_id,$first_name,$last_name,$phone_number,$date_of_birth,$email,$address){
        $sqlStmt="INSERT INTO person (organization_fk_id, first_name, last_name, phone_number,date_of_birth,email,address) VALUES (".'\''.$organization_id.'\''.",".'\''.$first_name.'\''.",".'\''.$last_name.'\''.",".'\''.$phone_number.'\''.",".'\''.$date_of_birth.'\''.",".'\''.$email.'\''.",".'\''.$address.'\''.")";
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes DELETE query to delete a person given its id (primary key)
    public function deletePerson($person_id){
        $sqlStmt="DELETE FROM person WHERE person_id=".$person_id;
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes SELECT query to return a single row providing the id(id is primary key so its unique thus only 1 row returns)
    public function SelectPersonById($person_id){
        $sqlStmt="SELECT * FROM person WHERE person_id=".$person_id; 
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes SELECT query to return many person rows given the foreign key organization id thus the result returned contains person that are in an organization with id=organization_id
    public function SelectPersonFromOrganization($organization_id){
        $sqlStmt="SELECT * FROM person WHERE organization_fk_id=".$organization_id; 
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes UPDATE query to update a person information given his id (primary key)
    public function updatePerson($person_id,$first_name,$last_name,$phone_number,$date_of_birth,$email,$address){
        $sqlStmt="UPDATE person SET first_name=".'\''.$first_name.'\''.",last_name=".'\''.$last_name.'\''.",phone_number=".'\''.$phone_number.'\''.",date_of_birth=".'\''.$date_of_birth.'\''.",email=".'\''.$email.'\''.",address=".'\''.$address.'\''." WHERE person_id=".$person_id;
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes SELECT query to return the number of selected rows of persons who are in a specific organization
    public function getNumberOfPersonsForOrganization($organization_id){
        $sqlStmt="SELECT COUNT(*) FROM person WHERE organization_fk_id=".$organization_id; 
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
}
?>