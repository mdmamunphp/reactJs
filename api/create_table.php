<?php
  //require_once("db_config.php");  
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
  header('Content-type:application/x-www-form-urlencoded');
  header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
  header('Content-Type: application/json');  
  
  //$method = $_SERVER['REQUEST_METHOD'];
  

		
 
  
  $db=new mysqli("localhost","root","","hrm");
  
 
  $user_arr=array();
   $users=$db->query("CREATE TABLE Persons (
    PersonID int,
    LastName varchar(255),
    FirstName varchar(255),
    Address varchar(255),
    City varchar(255)
)");
   
   if($users){
	   
	   echo "ok";
   }
   else{
	   echo "not ok";
   }
  
  header('Content-Type: application/json');  
  echo json_encode($user_arr);
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 
 


 
?>