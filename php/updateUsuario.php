<?php

include 'awFunctions.php';
include 'persona.php';
include 'empresa.php';
include 'usuario.php';

$con =createConnection();

	//$usr =  htmlspecialchars(trim(strip_tags($_POST['nombre'])));
	$mail = htmlspecialchars(trim(strip_tags($_POST['mail'])));
	$pass = htmlspecialchars(trim(strip_tags($_POST['pass1'])));
	$pass2= htmlspecialchars(trim(strip_tags($_POST['pass2'])));
	//$dir = htmlspecialchars(trim(strip_tags($_POST['dir']))); 

try{
	session_start();
	
	$usr = $_SESSION['nick'];
	//echo 'window.alert("entro en update Empresa")';
	
		
		if($pass!="" and $pass2!=""){
				/*password match*/
				if(0!=strcmp($pass,$pass2)){
					
					closeConnection($con);
					echo '<script language="javascript">';
					echo 'window.alert("passwords do not match")';
					echo '</script>';
					echo '<script language="javascript">';
					echo 'window.location.href = "http://localhost/meeze/usuarios/usersSearch.php"';//hacer bien el redirecrionamiento
					echo '</script>';
				}
				else{
				$pass= md5($pass);
				updatePass($con,$usr,$pass);
				}//make the update}
				
		}
				
				//if($dir!="")updateEmpresa2($con,$usr,$dir);
				if($mail!="")updateCorreo($con,$usr,$mail);
			
			
				
			
			echo '<script language="javascript">';
			echo 'window.location.href = "http://localhost/meeze/usuarios/usersSearch.php"';//hacer bien el redirecrionamiento
			echo '</script>';
		
			
			
			
		
	}catch(Exception $e){
	
	CaptureExceptionMns($e);

}

/*En caso de problemas cerramos conexión*/
closeConnection($con);
?>