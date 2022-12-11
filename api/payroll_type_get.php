<?php
  //require_once("db_config.php");  
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
  header('Content-type:application/x-www-form-urlencoded');
  header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
  header('Content-Type: application/json');  
  
  //$method = $_SERVER['REQUEST_METHOD'];
  

		
 
  
  $db=new mysqli("localhost","mamunboo_react","@28966931","mamunboo_react");
  
 
  $user_arr=array();
   $users=$db->query("SELECT id,name from payroll_type");
   while(list($id, $name)=$users->fetch_row()){
	   array_push($user_arr,array("id"=>$id,"name"=>$name));
   }
  
  header('Content-Type: application/json');  
  echo json_encode($user_arr);
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 
 


 
?>