<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<link rel="stylesheet" type="text/css" href="../CSS/styles.css">

<body>
<div class="contenedor" >
  	<!--CABECERA -->
	<div class="cabecera" >
	  <img  id="logo-cabecera" src="../img/400-80.png">
	   <div id="label-button">
       <p id="p-cabezera">Usuario: Empresa</p>
       <button id="boton-cabezera" onclick="parent.location='../index.html'">Salir</button>
     </div>
	  <nav id="nav-cabecera">
		    <ul>
		      <li><a href="empresaEventos.php">EVENTOS</a></li>
		      <li><a href="empresaPerfil.php">PERFIL</a> 
		        <ul>
		            <li><a href="/email">Submenu 0</a></li>
		            <li><a href="/contact_form">Submenu 1</a></li>
		            <li><a href="/pigeon">Submenu 2</a></li>
		        </ul>
		      </li>
		    </ul>
		</nav>
	</div>
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico" >
	   <!--SUBCONTENEDOR IZQ-->
	   <div id="contenedor_izq">
	   		<h1 id="titulo">EVENTO GENERADO POR: EMPRESA 2</h1>
	   		<img id="imgEvento" src="../img/logo.png" alt="Logo">
	   </div>
	   <!--SUBCONTENDOR DER-->
	   <div id="contenedor_der">
	   		<table id="formulario">
					<form action>
						<tr>
							<td> Nombre: </td> <td><input type="text" name="nombre" value=""></td>
						</tr>
						<tr>
							<td>Descripcion: </td> <td><input type="text" name="description" value=""></td>
						</tr><tr>
							<td>Fecha: </td> <td><input type="text" name="fecha" value=""></td>
						</tr><tr>
							<td>Hora inicio: </td> <td><input type="text" name="hora" value=""></td>
						</tr>
						<tr><td>Privacidad: </td><td>
							<input list="browsers" name="browser">
							<datalist id="browsers">
							  <option value="Privado">
							  <option value="Publico">
							</datalist>
						</td></tr>
						<tr>
							<td>Imagen evento: </td> <td><input type="text" name="image" value=""></td>
						</tr>

					</form>
			</table>
			<input type="Submit" value="Solicitar evento">
	   </div>
	</div>
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>