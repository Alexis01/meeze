<?php

include 'awFunctions.php';
include 'evento.php';


session_start();
$id =  htmlspecialchars(trim(strip_tags($_POST['evento'])));
$nick = $nick =$_SESSION['nick'];


 try{

			  	
	$con =createConnection();  
	 
	 /*exist the event*/
	 if(checkExistEvento($con, $id)){


	 	insertUserEvento($con,$nick,$id);
	 

	 }else throw new Exception('Event does not exits ');
			     
	 
	


	}catch(Exception $e){
			        
		CaptureExceptionMns($e);
	
	}
	closeConnection($con);

				


	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/usuarios/usersPerfil.php"';
	echo '</script>';









?>