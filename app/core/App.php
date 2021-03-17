<?php
class App
{

  protected $controller = 'OrganizationController'; //default controller

  protected $method = 'index'; //default method from the controller


  public function __construct($postArray)
  {
    $url = $this->parseUrl();  //explode $_GET['url']  which is everything after public/ 

    if (file_exists('../app/controllers/' . $url[0] . '.php')) {
      $this->controller = $url[0]; //store the controller provided in the URL as string firstly
      unset($url[0]);
    }

    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller; //initiate the controller following the controller provided in the URL

    if (isset($url[1])) {//check if a method is provided
      if (method_exists($this->controller, $url[1])) {  //to check if the method exists in the controller
        $this->method = $url[1];//store the method from the URL as string
        unset($url[1]);
      }
    }
    $urlArrayArgs=$url ?  array_values($url) : [];//check if the URL contains parameters which will be provided after the method name in the URL and transform them into an array, if not, just put an empty array
    for($i=0;$i<count($urlArrayArgs);$i++)//we will be putting any provided argument at the head of the array(before the post arguments if there was any)
      array_unshift($postArray,$urlArrayArgs[$i]); //$postArray will contain the arguments from the url and the POST parameters if any provided

      $res = call_user_func_array([$this->controller, $this->method], $postArray); //execute the method provided from the controller provided using the parameters
    if($res!=NULL)
      echo $res;//if a result was returned echo it so that AJAX can take it and use it
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {  //after public/
       return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)); //FILTER_SANITIZE_URL remove all the illegal characters from the url
      }//example if /public/AdminController/adminLogin => url[0] = AdminController and url[1] = adminLogin
  }
}
?>