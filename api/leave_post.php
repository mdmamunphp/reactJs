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
	  $leave_type_id=$_POST["leave_type_id"];	 
	  $leave_reason=$_POST["leave_reason"];	
	  $start_date=$_POST["start_date"];	
	  $end_date=$_POST["end_date"];	
	   $remark=$_POST["remark"];	
	  $sql="insert into leave_application set employee_id='$id', leave_type_id='$leave_type_id', leave_reason='$leave_reason', start_date='$start_date', end_date='$end_date', remark='$remark'";
	$db->query($sql);
	  file_put_contents("data.txt",$id." | ".date("d-m-Y")."\n".$method,FILE_APPEND);  
      	  
	  $success="1";
	  
  }
 
  header('Content-Type: application/json');  
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 echo json_encode($_POST);
  
?>