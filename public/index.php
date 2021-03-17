<?php
require_once '../app/init.php';  //core
$postParameters=[];  //array to store POST parameters for the methods.
foreach($_POST as $key=>$value){
    $postParameters[$key]=$value;  //put POST args in the array if they exist
}
session_start();//start a session to use its variable
$app = new App($postParameters);//initiate App class which will route to the controller and funciton provided in the url
?>
