<?php
  //require_once("db_config.php");  
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
  header('Content-type:application/x-www-form-urlencoded');
  header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
  
  


		
    $db=new mysqli("localhost","mamunboo_react","@28966931","mamunboo_react");
    $user_arr=array();
  if(isset($_GET["res"])){
	  
	  if($_GET["res"] !== "monthly"){
		  
			$s=$_GET["res"];	  
	
			$users=$db->query("select o.id, e.name,o.overtime_date, o.hours, o.description from overtime o join employee e on  o.employee_id=e.id where name like '%$s%' or overtime_date like '%$s%' or o.id like '%$s%' or o.hours like '%$s%'");
   

	  
	  }else{
			  
		$users=$db->query("select o.id, e.name,o.overtime_date, o.hours, o.description from overtime o join employee e on  o.employee_id=e.id");
	  
	   }
	   
	   
	   if($_GET["res"] == "monthly"){
		   
	
		   $users=$db->query("select o.id, e.name,o.overtime_date, o.hours, o.description from overtime o join employee e on  o.employee_id=e.id");
	   }



	while(list($id,$employee_id,$date,$hours,$remark)=$users->fetch_row()){

	   array_push($user_arr,array("id"=>$id,"employee_id"=>$employee_id,"overtime_date"=>$date,"hours"=>$hours,"description"=>$remark));
   
   
		}
   
   
  }
 // select o.id, e.name, MONTHNAME(o.overtime_date), o.hours, o.description from overtime o join employee e on  o.employee_id=e.id group by o.overtime_date, o.hours, o.description
	 
  header('Content-Type: application/json');  
 
 echo json_encode($user_arr);
	   
	   

  
?> 
 