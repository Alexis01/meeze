<?php

include 'awFunctions.php';
include 'evento.php';


session_start();
$id =  htmlspecialchars(trim(strip_tags($_POST['id'])));
$nick = $_SESSION['nick'];

 try{

			  	
	$con =createConnection();  
	 
	 /*exist the event*/
	 if(checkExistEvento($con, $id)){

	 	/*check if the event belongs to the enterprise*/
	 	if(perteneceEventoEmpresa ($con, $nick,$id))
	 		deleteEvento ($con, $id);

	 }else throw new Exception('Event does not exits 2');
			     

	}catch(Exception $e){
			        
		CaptureExceptionMns($e);
	
	}
	closeConnection($con);

				


	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/empresa/empresaHome.php"';
	echo '</script>';

?>