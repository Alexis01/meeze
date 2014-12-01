<?php 
        /*COMPROBAMOS DE VERDAD QUE SOMOS ADMIN*/
        session_start(); 
        $id=$_SESSION['id_perfil'];
        if($id!="1"){
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
		      <li><a href="adminclientes.php" class="boton1">Administrar Clientes</a></li>
		      <li><a href="adminEmpresa.php" class="boton1">Administrar Empresa</a>          
		      <li><a href="admin_events.php" class="boton0">Administrar Eventos</a>
		    </ul>
		</nav>
	</div>
	
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico" id="descuadrado" >
		 <h3>Eventos sin autorizar:</h3>
		  <?php
		      include '../php/evento.php';
		      include '../php/awFunctions.php';
		      try{
		  
		      $con =createConnection();  
		      /*muestra los eventos sin autorizar*/ 
		      $autorizado="0";
		      selectEventoAutorizacion ($con, $autorizado);
		      

		      }catch(Exception $e){
		        CaptureExceptionMns($e);

		      }
		      closeConnection($con);

		    ?>
		     <h2>Autorizar eventos :</h2>
			  <form method="POST" action="../php/darAltaEvento.php" name="alta evento">
			    Introduce el evento : 
			    <input  name="evento" placeholder="id" required></li> 
			    <input type="submit" value="confirma"></input>
			  </form>
	   
	</div>
	
	
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>