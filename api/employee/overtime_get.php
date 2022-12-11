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
	 // $eid=$_POST["eid"];
	    $user_arr=array();
		$overtime="";
   $users=$db->query("SELECT sum(hours) overtime FROM overtime where employee_id='$id';");
   while(list($time)=$users->fetch_row()){
	  // array_push($user_arr,array("overtime"=>$overtime));
	  $overtime=$time;
   }
  
  header('Content-Type: application/json');  
  echo json_encode($overtime);
	 
	 
	 
	 
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