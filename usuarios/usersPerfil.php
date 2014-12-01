<?php 
        /*COMPROBAMOS DE VERDAD QUE SOMOS ADMIN*/
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
		     <li><a href="usersHome.php" class="boton1">Agenda</a></li>      
		      <li><a href="usersPerfil.php" class="boton0">Eventos</a>
		     <li><a href="usersSearch.php" class="boton1" >Perfil</a> 	
		    </ul>
		</nav>
	</div>
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico" >
	   <!--SUBCONTENEDOR IZQ-->
	   <div id="contenedor_izq">
	   		
	   		<h2>Apuntate a un Evento :</h2>
	   		<form method="POST" action="../php/apuntarseEvento.php" name="apuntarse_evento">
			  
			    <input  name="evento" placeholder="evento" required></li> 
			    <input type="submit" value="voy!"></input>
			</form>
			<h2>Eventos disponibles :</h2>
	   			<?php 
	   			include '../php/evento.php';
			    include '../php/awFunctions.php';
			    try{
			  
			     $con =createConnection();  
			     $autorizado = '1'; //1 eventos autorizados
			    selectEventoAutorizacion($con, $autorizado);   
			    
			    }catch(Exception $e){
			        
			        CaptureExceptionMns($e);
			    }
			    closeConnection($con);

	   			?>
	   	
	   </div>
	   <!--SUBCONTENDOR DER-->
	   <div id="contenedor_der">
	   		
	   		<h2>Desapuntate de un Evento :</h2>
			<form method="POST" action="../php/quitarEvento.php" name="quitar_evento">
			    
			    <input  name="qevento" placeholder="Introduce el ID" required></li> 
			    <input type="submit" value="Darme de Baja!"></input>
			</form>
			<h2>Eventos Apuntado :</h2>
			<?php 
	   			
			    try{
			  	
			     $con =createConnection();  
			     $nick =$_SESSION['nick'];
			     
			     selectEventoAsistir($con, $nick);   
			    
			    }catch(Exception $e){
			        
			        CaptureExceptionMns($e);
			    }
			    closeConnection($con);

	   			?>

			
	   		

	   </div>
	</div>
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>