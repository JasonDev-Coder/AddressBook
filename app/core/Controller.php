<?php
class Controller
{
  //function to initiate a model and return it
  public function model($model)
  {
    require_once '../app/models/' . $model . '.php';
    return new $model();
  }
  //function to redirect to a given view
  public function view($view)
  {
    header("Location: /AddressBook/app/views/" . $view . ".php");
  }
}
?>