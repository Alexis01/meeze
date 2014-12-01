<?php

//NOTA:ESTE SESSION TIENE QUE IR DONDE ESTAN EL RESTO DE LOS HTML FUERA DE LA CARPETA , los include son direccionabls a la carpeta php
include 'awFunctions.php';
include 'persona.php';

/*check para caracteres indeseados*/
$usr = htmlspecialchars(trim(strip_tags($_POST['usermail'])));
$pass = htmlspecialchars(trim(strip_tags($_POST['password'])));

/*Contraseña a md5*/
$pass = md5(htmlspecialchars(trim(strip_tags($_POST['password']))));

///$idPer->1 admin ,2 empresa ,3 usuarios

$con =createConnection();

try {
	/*Comprobamos que los datos son correctos y los adquirimos de la BBDD*/
	$res=selectLogUsr($con,$usr,$pass);

	session_start();
	$_SESSION['nick']=$res['nick'];
	$_SESSION['id_perfil']=$res['id_perfil'];
	
	
	/*USUARIO*/
	if($_SESSION['id_perfil']=="3"){

		$res2=giveUsrDat($con,$usr);
		//NOTA: al traer el avatar es una direccion, ha de ser tratada para obtener la imagen y almacenarla en session
		$_SESSION['avatar']=$res2['avatar'];
		$_SESSION['fecha_nac']=$res2['fecha_nac'];
		$_SESSION['descrip']=$res2['descrip'];


		echo '<script language="javascript">';
		echo 'window.location.href = "http://localhost/meeze/usuarios/usersHome.php"';
		echo '</script>';


	}elseif ($_SESSION['id_perfil']=="2") {
		$res2=giveEmpDat($con,$usr);
		$_SESSION['logo']=$res2['logo'];
		$_SESSION['dir']=$res2['dir'];
		
		echo '<script language="javascript">';
		echo 'window.location.href = "http://localhost/meeze/empresa/empresaHome.php"';
		echo '</script>';
	/*ADMIN*/
	}elseif ($_SESSION['id_perfil']=="1") {
		
		echo '<script language="javascript">';
		echo 'window.location.href = "http://localhost/meeze/administrador/adminclientes.php"';
		echo '</script>';
	}
	

}catch(Exception $e){

	CaptureExceptionMns($e);
	
	echo '<script language="javascript">';
	echo 'window.location.href = "http://localhost/meeze/index.html"';
	echo '</script>';

}
closeConnection($con);




?>