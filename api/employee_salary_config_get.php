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
  


	
	    $user_arr=array();
   $users=$db->query("SELECT esc.id id, p.name name, esc.amount amount FROM employee_salary_config esc join payroll_type p on p.id=esc.payroll_type_id ");
   while(list($id, $name, $amount)=$users->fetch_row()){
	   array_push($user_arr,array("id"=>$id, "name"=>$name, "amount"=>$amount));
   
  
  header('Content-Type: application/json');  
  echo json_encode($user_arr);
	 
	 
	 
	 
	
  }

  
?>