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
        echo "Usuario: ".$nick." (User) ";
           ?>
       </p>
	  
	  <nav id="nav-cabecera">
		  <ul>
		     <li><a href="usersHome.php" class="boton1">Agenda</a></li>      
		      <li><a href="usersPerfil.php" class="boton1">Eventos</a>
		     <li><a href="usersSearch.php" class="boton0" >Perfil</a> 	
		    </ul>
		</nav>
	</div>
	<!--CONTENEDOR CENTRAR -->
	<div class="contenedor_generico" >
	   <!--SUBCONTENEDOR IZQ-->
	   <div id="contenedor_izq">
	   <h1 id = "titulo"><?php echo 
			$_SESSION['nick']; ?></h1>
	   		<img id ="logoPerfil" src="../img/icoUserDefault.jpg" alt="Logo">
	   		
	   	
	   </div>
	   <!--SUBCONTENDOR DER-->
	
	   <div id="contenedor_der">
		<?php 	
					include '../php/awFunctions.php';
					include '../php/usuario.php';
					include '../php/persona.php';
					  try{
				  
					  $con =createConnection(); 
					  
					  $nick=$_SESSION['nick'];
					   
					   $correo = selectcorreo($con,$nick);
					   
					  
					  }catch(Exception $e){
						CaptureExceptionMns($e);

					  }
					  closeConnection($con);
				  ?>
	   		<form id="formulario"  action="../php/updateUsuario.php" method="post">
				<ul>  

			        <li> <label for="password">Password:</label>  
			        <input type="password" name="pass1" placeholder="password"> </li> 
			        <li> <label for="password">Repeat	 pass:</label>  
			        <input type="password" name="pass2" placeholder="password"> </li>
					<li> <label for="correo">Correo:</label>  
			        <input type="mail" name="mail" placeholder=<?php echo $correo ?> > </li>
			        <input type="submit" value="Guardar" style=" margin-left: 19%;"></li>  
			    </ul>  
			</form>

	   </div>
	</div>
	<!--PIE DE PAGINA -->
	<div class="footer" >
	 	<p id="textFooter">Copyright © 2014 Madrid. Some rights reserved. </p> 
	 </div>



</div>



</body>
</html>