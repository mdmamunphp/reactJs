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
  function checkExt($field){
    $ext = "";
    if($_FILES[$field]['name']){
      $extension = pathinfo($_FILES[$field]['name']);
      $ext = strtolower($extension['extension']);
      if($ext != 'jpg' && $ext != 'png' && $ext != 'gif' && $ext != 'jpeg'  && $ext != 'pdf'){
        $ext = "";
      }
    }
    return $ext;
}
    $db=new mysqli("localhost","mamunboo_react","@28966931","mamunboo_react");
  
  $success=0;
  if(isset($_POST)){
	    $id=$_POST["id"];	
	  $name=$_POST["name"];	 
	  $email=$_POST["email"];	 
	  $password=$_POST["password"];	
	  $role_id=$_POST["role_id"];	
	  $img=$_POST["images"];
	  $sql="update users set name='$name', email='$email', password='$password', role_id='$role_id', images='$img' where id='$id'";
	$db->query($sql);
	  //file_put_contents("data.txt",$id." | ".date("d-m-Y")."\n".$method,FILE_APPEND);  
      	  
	  $success="1";
	  
  }
 
  header('Content-Type: application/json');  
 // echo json_encode(array("success"=>$_POST["name"]));
 //echo json_encode(array("success"=>$data));
 echo json_encode($sql);
  
?>