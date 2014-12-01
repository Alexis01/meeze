<?php
//EN principio esto FUNCIONA FALTA QUE CONGOSTO NOS ILUMINE COMO COÑO INSERTA.
include 'awFunctions.php';
include 'evento.php';



/*
To pass data from one page to another, you first need to declare session_start() 
on all pages that are going to use $_SESSION superglobal variable. 
*/	
	/*NOTA: obligatorio en todas las paginas donde se utilice la session.*/
	session_start();
	
	$con =createConnection();
	

	$ambito=$_POST['browser'];
	
	$comp =strcmp ($ambito  , "Publico" );
	
	//NOTA:privacidad es un var char no un INT; si son iguales $comp ==0
	if( $comp==0){
		$privacidad='1';
	}else $privacidad='0';
	
try{
	
	
	$nick=$_SESSION['nick'];
	$nombre = $_POST['nombre'];
	$descrip = $_POST['description'];
	
	/*NOTA: utilizo una adaptaon mia para que introduzca al menos algo*/
	insertEvento2($con,$nombre, $descrip,$privacidad, $nick);
	
	/*En caso de ejecutarlo bien cerramos conexión*/
	closeConnection($con);

	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/empresa/empresaHome.php"';
	echo '</script>';
	

}catch(Exception $e){
	
	CaptureExceptionMns($e);

}

/*En caso de problemas cerramos conexión*/
closeConnection($con);
?>