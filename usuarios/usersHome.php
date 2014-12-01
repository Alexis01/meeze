<?php 
        /*COMPROBAMOS DE VERDAD QUE SOMOS USUARIO*/
        session_start(); 
        $id=$_SESSION['id_perfil'];
        if($id!="3"){
      echo '<script language="javascript">';
      echo 'window.location.href = "http://localhost/meeze/index.html"';
      echo '</script>';
      //y le cerramos la session.
      session_destroy();
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<link rel="stylesheet" type="text/css" href="../CSS/styles.css">

<body>
<div class="contenedor" >
<img  id="fondo-img" src="../img/fondo.png" >
  	<!--CABECERA -->
	<div class="cabecera" >
	  <img  id="logo-cabecera" src="../img/400-80.png">
	   <div id="label-button">
       
       		
       <button id="boton-cabezera" onclick="parent.location='../php/killSession.php'">Salir</button>
     </div>
	  <!--a cambiar -->
	  <p id="p-cabezera">
	  <?php 
        /*PEQUEÑO PHP PARA VER COMO SERÍA*/
        //session_start(); 
        $nick=$_SESSION['nick'];
        echo "Usuario: ".$nick." (User) ";
           ?>
       </p>
	  <nav id="nav-cabecera">
		   <ul>
		     <li><a href="usersHome.php" class="boton0">Agenda</a></li>      
		      <li><a href="usersPerfil.php" class="boton1">Eventos</a>
		     <li><a href="usersSearch.php" class="boton1" >Perfil</a> 	
		    </ul>
		</nav>
	</div>
	<!--a cambiar -->
	
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico"  id="descuadrado">
		<h1 class="headers">Agenda Mensual</h1>
		<h1 class="headers"><?php
			echo "Fecha: " . date("Y/m/d") ." " . date("h:i") . "<br>";

			?></h1>
			
		<?php		
					include '../php/awFunctions.php';
					include '../php/evento.php';
					
					  try{
				  
					  $con =createConnection(); 
					  
					  $nick=$_SESSION['nick'];
					   
					  echo  selectEventoAsistir($con, $nick);
					   
					  
					  }catch(Exception $e){
						CaptureExceptionMns($e);

					  }
					  closeConnection($con); ?>
	</div>
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>