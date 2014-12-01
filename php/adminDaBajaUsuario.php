<?php

/*PHP que se ejecuta cuando un admin da a borrar un usuario*/

include 'awFunctions.php';
include 'persona.php';

//$nick = htmlspecialchars(trim(strip_tags($_POST['nombre'])));
//echo $nick;
$usr = htmlspecialchars(trim(strip_tags($_POST['usermail'])));
//echo $usr;
try{
	
	$con=createConnection();
	
	//$nick="usuario";
	if(checkExists($con,$usr)){
		
		
		/*Nos aseguramos que el usr existe*/
		if(ExistUsr($con,$usr))
			deletePersona($con,$usr);
			
		
		

}else throw new Exception('user incorrect') ;

}catch(Exception $e){
	//echo 'open exception';
	CaptureExceptionMns($e);
	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/administrador/adminclientes.php"';
	echo '</script>';

}
closeConnection($con);

echo '<script language="javascript">';
echo 'window.location.href = "http://localhost/meeze/administrador/adminclientes.php"';
echo '</script>';




?>