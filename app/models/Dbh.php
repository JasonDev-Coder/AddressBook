<?php
//super class Dbh create a connection with the database with the given parameters
class Dbh{
    private $servername="localhost";
    private $username="root";
    private $password="";
    private $dbname="addressbook";//database name
    private $isConnected=false;//boolean to check if we are connected to the database
    private $mysqliConnect;
    public function connect(){
        $this->mysqliConnect=new mysqli($this->servername,$this->username,$this->password,$this->dbname) or die("Could not connect");
        $this->isConnected=true;
        return $this->mysqliConnect;//create a connection and return it
    }
    //close a connection
    public function closeConnection(){
        if($this->isConnected){
            $this->mysqliConnect->close();
            $this->isConnected=false;
        }
    }
}
?>