<?php

/*
ESTE FICHERO TENDRA FUNCIONES DE MEEZE GÉNERICAS ES DECIR QUE SE PUEDAN UTILIZAR EN TODO EL PROYECTO POR AHORA SON ESTAS
PERO SE A MEDIDA QUE AVANCE EL PROYECTO HARÁ FALTA HACER MÁS.	
*/

 /*informs about successful operations*/
 function infoAds($msn){
	$msn=$msn." has been successful";
	echo '<script type="text/javascript">alert("' . $msn . '"  ); </script>';
 }

 /*informs about registrations operations*/
 function infoAds2($nick){
	$msn = 'Registration has been succesful, welcome '.$nick;
	echo '<script type="text/javascript">alert("' . $msn . '"  ); </script>';
 }

 /*Create connection*/
function createConnection(){
	$con=mysqli_connect("localhost", "root", "", "meeze");
	//echo "Success to connect to MySQL: ";
	// echo "<br>";
	 //Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }else return $con;
}
 ?> 

 
 <?php
 /*close connection*/
 function closeConnection($con){
	
		mysqli_close($con);
	
	
	//echo "Success to disconnect from MySQL: ";
 	//echo "<br>";
 }
?>

<?php
 /*informa acerca de error por excepciones,produce un pop-up JS, FUNCIONA*/
 function CaptureExceptionMns(Exception $e){
	$msn = $e->getMessage();
	echo '<script type="text/javascript">alert("' . $msn . '"); </script>';
 }
?>

<?php
/*ConsultaPersona(Para insertar Usuario o Empresa o Admins, primero han de estar los datos en la tabla de persona)
Esta fun es lo que hace, consulta si algún usuario ya está en la bbdd con ese nick o no antes de insertar o borrar*/

function checkExists($con,$nick){
	$nick =mysqli_real_escape_string($con,$nick);
	if($stmt = mysqli_prepare($con,"SELECT  nick FROM persona where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "s", $nick);

			    /* ejecutar la consulta */
			    mysqli_stmt_execute($stmt);
			    
			    /* vincular variables a la sentencia preparada */
			    mysqli_stmt_bind_result($stmt, $res);
			   
			    /*pasar los valores a $res*/
			    mysqli_stmt_fetch($stmt);

			    /*cerramos stmt*/
			    mysqli_stmt_close($stmt);
			   
			    $com= strcmp($nick,$res);
			    if($com==0){
			    	return True;
			    }else return FALSE;
		}else throw new Exception('Problem to connect the DB ');
}
?>


<?php
/*Da los datos de la empresa para porder pasarselos cuando un usuario se quiere loguear como empresa en la api*/
function giveEmpDat($con,$nick){

	if($stmt = mysqli_prepare($con,"SELECT * FROM empresa where nick = ?")){

		/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "s", $nick);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1,$col2,$col3,$col4);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($nick,$col1);
		    if($coin ==0){		    	
		    		/*Si todo va bien obtenemos TODO relativo a la Empresa y lo devolvemos*/
		    		$res =["nick"=>$col1,"logo"=>$col2,"dir"=>$col3,"descrip"=>$col4 ];
					 /*Devolvemos el resultado*/
    				 return $res;
			}else throw new Exception('user incorrect') ;
		}else throw new Exception('Problem to connect the DB ');
}
?>

<?php
/*Nos dice si existe una empresa con ese nick*/
function ExistEmp($con,$nick){

	if($stmt = mysqli_prepare($con,"SELECT nick FROM empresa where nick = ?")){

		/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "s", $nick);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($nick,$col1);
		    if($coin ==0){		    	
		    		return true;
			}else throw new Exception('incorrect Enterprise') ;
		}else throw new Exception('Problem to connect the DB ');
}
?>

<?php
/*Nos dice si existe un usr con ese nick*/
function ExistUsr($con,$nick){

	if($stmt = mysqli_prepare($con,"SELECT nick FROM usuario where nick = ?")){

		/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "s", $nick);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($nick,$col1);
		    if($coin ==0){		    	
		    		return true;
			}else throw new Exception('incorrect user') ;
		}else throw new Exception('Problem to connect the DB ');
}
?>



<?php
/*Da los datos del usuario para porder pasarselos cuando un usuario se quiere loguear como empresa en la api*/
function giveUsrDat($con,$nick){

	if($stmt = mysqli_prepare($con,"SELECT * FROM usuario where nick = ?")){

		/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "s", $nick);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1,$col2,$col3);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($nick,$col1);
		    if($coin ==0){		    	
		    		/*Si todo va bien obtenemos TODO relativo a la Empresa y lo devolvemos*/
		    		$res =["nick"=>$col1,"avatar"=>$col2,"fecha_nac"=>$col3 ];
		    		 /*Devolvemos el resultado*/
    				 return $res;
			}else throw new Exception('user incorrect') ;
		}else throw new Exception('Problem to connect the DB ');
}
?>



