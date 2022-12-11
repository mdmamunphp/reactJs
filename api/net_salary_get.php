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
	  $id=$_POST["id"];	 
	   $m_id=$_POST["m_id"];	 
	 // $eid=$_POST["eid"];
	$add="";
 $d="";
 $ab="";
 $over="";
  $user_arr=array();
   $users=$db->query("SELECT sum(esc.amount) addamount,
						(SELECT sum(esc.amount) damount FROM employee_salary_config esc join payroll_type pt on esc.payroll_type_id=pt.id and esc.employee_id='$id' and pt.type='2') damount,
						(SELECT count(employee_id) absent FROM attendance where employee_id='$id' and type=1 and month(date)='$m_id') absent, 
						(SELECT sum(hours) overtime FROM overtime where employee_id='$id' and month(overtime_date)='$m_id') overtime
					FROM employee_salary_config esc join payroll_type pt on esc.payroll_type_id=pt.id and esc.employee_id='$id' and pt.type='1'");
   while(list($addamount,$damount,$absent,$overtime)=$users->fetch_row()){
	 //  array_push($user_arr,array("addamount"=>$addamount,"damount"=>$damount));
	   $add=$addamount;
	   $d=$damount;
	   $ab=$absent;
	   $over=$overtime;
   }
  $net_salary=$add-$d;
  $overtime_amount=$over*2*($net_salary/26/9);
  $absent_amount=$ab*($net_salary/26);
  $total_salary=$net_salary+$overtime_amount-$absent_amount;
  //array_push($user_arr,array("net_salary"=>$net_salary));
  
  header('Content-Type: application/json');  
  echo json_encode($total_salary);
	 
	 
	 
	 
	// $sql="SELECT count(employee_id) absent FROM attendance where employee_id='2' and type=1;";
	//$data=$db->query($sql);
	//  file_put_contents("data.txt",$id." | ".date("d-m-Y")."\n".$method,FILE_APPEND);  
      	  
	//  $success="1";
	//  echo $data['absent'];
  }
 
//  header('Content-Type: application/json');  
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
// echo json_encode($data);
  
?>