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
   $users=$db->query("select t.id, e.name,t.date, t.hours, t.remark from timesheet t join employee e on  t.employee_id=e.id");
   while(list($id,$employee_id,$date,$hours,$remark)=$users->fetch_row()){
	   array_push($user_arr,array("id"=>$id,"employee_id"=>$employee_id,"date"=>$date,"hours"=>$hours,"remark"=>$remark));
   }
  
  header('Content-Type: application/json');  
  echo json_encode($user_arr);
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 
 


 
?>