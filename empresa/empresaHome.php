<?php 
       	/*COMPROBAMOS DE VERDAD QUE SOMOS EMPRESA*/
       	session_start(); 
       	$id=$_SESSION['id_perfil'];
       	if($id!="2"){
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
		     <li><a href="empresaHome.php" class="boton0">EVENTOS</a></li>
		      <li><a href="empresaPerfil.php" class="boton1">PERFIL</a> 
		      </li>
		    </ul>
		</nav>
	</div>
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico" >
	   <!--SUBCONTENEDOR IZQ-->
	   <div id="contenedor_izq">
	   		<h3>   Eventos de la empresa :</h3>
			<?php
				include '../php/awFunctions.php';
			    include '../php/empresa.php';
			    include '../php/evento.php';
			      try{
			  
			      $con =createConnection(); 
			      
			      $nick=$_SESSION['nick'];

			      selectEventoEmpresa ($con, $nick);
			      
			      }catch(Exception $e){
			        CaptureExceptionMns($e);

			      }
			      closeConnection($con);

    		?>
    		<h3>   Eventos a borrar :</h3>
    		<form method="POST" action="../php/BorraEmpresaEvento.php" name="Baja Empresa">
			     <input  name="id" placeholder="evento" required></li> 
			    <input type="submit" value="confirma"></input>

			</form>
			
	   </div>
	   <!--SUBCONTENDOR DER-->
	   <div id="contenedor_der">
	   		<button id="botones" onclick="parent.location='crearEvento.php'">GENERAR EVENTO:</button>
			<img id = "calendario" src="../img/empresax.jpg">
	   </div>
	</div>
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>