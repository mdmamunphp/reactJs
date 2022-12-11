<?php
  //require_once("db_config.php");  
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
  header('Content-type:application/x-www-form-urlencoded');
  header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
  
  
  $method = $_SERVER['REQUEST_METHOD'];
  

		
  if($method==='POST' && empty($_POST)) {
   $rest_json = file_get_contents("php://input");
    
   $_POST = json_decode($rest_json, true);
  }
  
  $db=new mysqli("localhost","root","","sales_management");
  
  $success=0;
  if(isset($_POST["name"])){
	  $name=$_POST["name"];	 
	  $email=$_POST["email"];	 
	   $sql="insert into customers set name='$name',email='$email'";
	//$d=$db->query($sql);
	  file_put_contents("data.txt",$name." | ".date("d-m-Y")."\n".$method,FILE_APPEND);  
      	  
	  $success="1";
	  
  }
  $data=$db->query("select * from customers");
  header('Content-Type: application/json');  
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 echo json_encode($data);
  
?>