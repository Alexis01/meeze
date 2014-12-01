<?php

include 'awFunctions.php';
include 'evento.php';


session_start();
$id =  htmlspecialchars(trim(strip_tags($_POST['qevento'])));
$nick = $nick =$_SESSION['nick'];


 try{
 	
			  	
	$con =createConnection();  
	 
	 /*exist the event*/
	 if(checkExistEvento($con, $id)){

	 	deleteEventoUser($con,$id,$nick);
	 	

	 

	 }else throw new Exception('Event does not exits ');
			     
	 
	


	}catch(Exception $e){
			        
		CaptureExceptionMns($e);
	
	}
	closeConnection($con);

				


	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/usersPerfil.php"';
	echo '</script>';

?>