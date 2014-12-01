<?php

/*PHP que se ejecuta cuando un admin da a borrar una empresa*/

include 'awFunctions.php';
include 'persona.php';

//$nick = htmlspecialchars(trim(strip_tags($_POST['nombre'])));
//echo $nick;
$usr = htmlspecialchars(trim(strip_tags($_POST['usermail'])));
//echo $usr;
try{
	
	$con=createConnection();
	
	//$nick="moviestar";
	if(checkExists($con,$usr)){
		
		
		/*Nos aseguramos que la empresa existe*/
		if(ExistEmp($con,$usr))
			deletePersona($con,$usr);
			
		
		

}else throw new Exception('user incorrect') ;

}catch(Exception $e){
	//echo 'open exception';
	CaptureExceptionMns($e);
	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/empresa/adminEmpresa.php"';
	echo '</script>';

}
closeConnection($con);

echo '<script language="javascript">';
echo 'window.location.href = "http://localhost/meeze/empresa/adminEmpresa.php"';
echo '</script>';




?>





