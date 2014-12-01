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
<link rel="stylesheet" type="text/css" href="../CSS/stylesCarlos.css">
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
        echo "Usuario: ".$nick." (Empresa) ";
           ?>
       </p>
	  <nav id="nav-cabecera">
		   <ul>
		     <li><a href="empresaHome.php" class="boton0">EVENTOS</a></li>
		      <li><a href="empresaPerfil.php" class="boton0">PERFIL</a> 
		      </li>
		    </ul>
		</nav>
	</div>
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico" >
	   <!--SUBCONTENEDOR IZQ-->
	   <div id="contenedor_izq">
	   		<h1 id="titulo">EVENTO GENERADO POR: <?php echo $nick;?></h1>
	   		<img id="imgEvento" src="../img/empresaDefault.jpg" alt="Logo">
	   </div>
	   <!--SUBCONTENDOR DER-->
	   <div id="contenedor_der">
	   		<table id="formulario">
					<form action="../php/demo.php" method="post" name="formEvent">
						<tr>
							<td> Nombre: </td> <td><input type="text" name="nombre" value=""></td>
						</tr>
						<tr>
							<td>Descripcion: </td> <td><input type="text" name="description" value=""></td>
						</tr>
						<tr><td>Privacidad: </td><td>
							<input list="browsers" name="browser">
							<datalist id="browsers">
							  <option value="Privado">
							  <option value="Publico">
							</datalist>
						</td></tr>
						<input type="Submit" value="solicitar evento">
					</form>
			</table>
			
	   </div>
	</div>
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>