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
  
  $db=new mysqli("localhost","mamunboo_react","@28966931","mamunboo_react");
  
  $success=0;
  if(isset($_POST)){
	  $id=$_POST["employee_id"];	 
	  $date=$_POST["overtime_date"];	 
	  $hours=$_POST["hours"];	
	  $description=$_POST["description"];	
	  $sql="insert into overtime set employee_id='$id',overtime_date='$date',hours='$hours',description='$description'";
	$db->query($sql);
	  file_put_contents("data.txt",$id." | ".date("d-m-Y")."\n".$method,FILE_APPEND);  
      	  
	  $success="1";
	  
  }
 
  header('Content-Type: application/json');  
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 echo json_encode($_POST);
  
?>