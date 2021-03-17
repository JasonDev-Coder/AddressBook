<?php
require_once 'Dbh.php';
//Organization Model class that extends the Dbh class to connect to the database and execute queries
class OrganizationModel extends Dbh{
    //function that executes INSERT query to insert a new organization row
    public function insertOrganization($name,$email,$phone_number,$location){
        $sqlStmt="INSERT INTO organization (organization_name, organization_email, organization_phone_number, organization_location) VALUES (".'\''.$name.'\''.",".'\''.$email.'\''.",".'\''.$phone_number.'\''.",".'\''.$location.'\''.")";
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes the DELETE query to delete an organization row
    public function deleteOrganization($organization_id){
        $sqlStmt="DELETE FROM organization WHERE organization_id=".$organization_id;
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes SELECT query to return all organization rows
    public function SelectAll(){
        $sqlStmt="SELECT * FROM organization"; 
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes SELECT query to return a single row providing the id(id is primary key so its unique thus only 1 row returns)
    public function SelectOrganization($id){
        $sqlStmt="SELECT * FROM organization WHERE organization_id=".$id; 
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
    //function that executes UPDATE query to update an organization row given its id (primary key)
    public function updateOrganization($id,$name,$email,$phone_number,$location){
        $sqlStmt="UPDATE organization SET organization_name=".'\''.$name.'\''.",organization_email=".'\''.$email.'\''.",organization_phone_number=".'\''.$phone_number.'\''.",organization_location=".'\''.$location.'\''."WHERE organization_id=".$id;
        $result=$this->connect()->query($sqlStmt);
        $this->closeConnection();
        return $result;
    }
}
?>