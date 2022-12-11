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
   $users=$db->query("SELECT la.id, e.name employee_name, lt.name leave_type_name,la.leave_reason, la.start_date, la.end_date, la.remark, la.status FROM ((leave_application la INNER JOIN leave_type lt ON la.leave_type_id = lt.id) INNER JOIN employee e ON la.employee_id = e.id)order by la.id asc;");
   while(list($id, $employee_id, $leave_type_id, $reason, $start_date, $end_date, $remark, $status)=$users->fetch_row()){
	   array_push($user_arr,array("id"=>$id, "employee_id"=>$employee_id, "leave_type_id"=>$leave_type_id, "reason"=>$reason, "start_date"=>$start_date, "end_date"=> $end_date, "remark"=>$remark, "status"=>$status));
   }
  
  header('Content-Type: application/json');  
  echo json_encode($user_arr);
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 
 


 
?>