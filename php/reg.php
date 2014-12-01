<?php

include 'awFunctions.php';
include 'persona.php';
include 'empresa.php';
include 'usuario.php';

$con =createConnection();

	$usr =  htmlspecialchars(trim(strip_tags($_POST['nombre'])));
	$mail = htmlspecialchars(trim(strip_tags($_POST['mail'])));
	$pass = htmlspecialchars(trim(strip_tags($_POST['pass1'])));
	$pass2= htmlspecialchars(trim(strip_tags($_POST['pass2'])));
	$type = htmlspecialchars(trim(strip_tags($_POST['type']))); 

try{
	
	/*does not exists user(entreprise)*/
	if(!checkExists($con,$usr)){

		/*password match*/
		if(0!=strcmp($pass,$pass2)){
			
			echo '<script language="javascript">';
			echo 'window.alert("passwords do not match")';
			echo '</script>';
			echo '<script language="javascript">';
			echo 'window.location.href = "http://localhost/meeze/index.html"';
			echo '</script>';
		}
		
		$pass= md5($pass);

		/*choose type user to insert (user , entreprise) */
		if($type=="usr" ){
			$id="3";
			insertPesona($con,$usr,$pass,$mail,$id);
			insertUsuario($con,$usr,null,null);

		}else{
			$id="2";
			$desc="Anima a la empresa a rellenar su descripción";
			insertPesona($con,$usr,$pass,$mail,$id);
			insertEmpresa($con,$usr,null,null,$desc);
		}
		
		
	}else {
	
	
			closeConnection($con);
			echo '<script language="javascript">';
			echo 'window.alert("user alredy exist")';
			echo '</script>';
			echo '<script language="javascript">';
			echo 'window.location.href = "http://localhost/meeze/index.html"';
			echo '</script>';
	
			}
}catch(Exception $e){
	
	CaptureExceptionMns($e);

}		
			/*En caso de problemas cerramos conexión*/
			closeConnection($con);
			
			echo '<script language="javascript">';
			echo 'window.location.href = "http://localhost/meeze/index.html"';
			echo '</script>';
	


?>