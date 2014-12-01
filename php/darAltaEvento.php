<?php

include 'awFunctions.php';
include 'evento.php';


session_start();
$id =  htmlspecialchars(trim(strip_tags($_POST['evento'])));



 try{

			  	
	$con =createConnection();  
	 
	 /*exist the event*/
	 if(checkExistEvento($con, $id)){

	 	autorizarEvento ($con, $id);

	 }else throw new Exception('Event does not exits ');
			     
	 
	


	}catch(Exception $e){
			        
		CaptureExceptionMns($e);
	
	}
	closeConnection($con);

				


	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/administrador/adminEmpresa.php"';
	echo '</script>';









?>