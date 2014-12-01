<?php
//include 'awFunctions.php';
/*Ojo: el nick no se cambia, además si se hiciera habría que cambiarlo en Persona, ya que se la clave primaria*/
function updateUsuario($con,$nick,$avatar,$fecha_nac){

	$nick =mysqli_real_escape_string($con,$nick); 
	$fecha_nac =mysqli_real_escape_string($con,$fecha_nac); 
	//$logo =file_get_contents($logo);
	if($stmt = mysqli_prepare($con,"UPDATE  usuario set nick =? , avatar=? , fecha_nac=? where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "ssss", $nick,$avatar,$fecha_nac,$nick);

			    /* ejecutar la consulta */
			    $res= mysqli_stmt_execute($stmt);
			    /*cerramos stmt*/
			    mysqli_stmt_close($stmt);
			    if($res==1){
			    	$msn = 'update';
			    	infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');
}


function selectUsuario($con){

	if($stmt = mysqli_prepare($con,"SELECT nick, fecha_nac FROM usuario ")){

		mysqli_stmt_execute($stmt);

		 /* vincular variables a la sentencia preparada */
	    mysqli_stmt_bind_result($stmt, $col1,$col2);

	    //otra forma de crear una tabla con los resultados.
	    echo "<table >
		<tr>
		<th>nombre</th>
		<th>direccion</th>
		</tr>";
	     /* obtener valores */
	    while (mysqli_stmt_fetch($stmt)) {
	         echo "<tr>";
			  echo "<td>" . $col1. "</td>";
			  echo "<td>" . $col2 . "</td>";
			  echo "</tr>";	
	    }
	     echo "</table>";
	    /* cerrar la $stmt */
   		mysqli_stmt_close($stmt);
 	}else throw new Exception('Problem to connect the DB ');


}


//Estilo por procedimientos(No orientado a objetos)
function deleteUsuario($con,$nick){
		$nick =mysqli_real_escape_string($con,$nick); 
		if ($stmt = mysqli_prepare($con,"DELETE FROM usuario WHERE nick = ? ") ){
		//mysqli_prepare() devuelve un objeto de sentencia o FALSE si ocurre un error

			    /* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "s", $nick);

			    /* ejecutar la consulta */
			    $res=mysqli_stmt_execute($stmt);   
				/* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	$msn = 'delete';
			    	infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');		
}


//Estilo por procedimientos(No orientado a objetos)
function insertUsuario($con,$nick,$avatar,$fecha_nac){
		
		
		$nick =mysqli_real_escape_string($con,$nick); 
		$fecha_nac =mysqli_real_escape_string($con,$fecha_nac);  
		//$logo=file_get_contents($logo);
		if ($stmt = mysqli_prepare($con,"INSERT INTO usuario (nick , avatar ,fecha_nac) VALUES (? , ? , ?)") ){

			    /* ligar parámetros para marcadores, sss-> string ,string, string, rellena los ? en el orden que se ponen  */
			    mysqli_stmt_bind_param($stmt, "sss", $nick,$avatar,$fecha_nac);

			    /* ejecutar la consulta */
			    $res=mysqli_stmt_execute($stmt);
			   // echo $res; 
			    /* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	//$msn = 'insert';
			    	//infoAds2($nick);
			    }else throw new Exception('Problem to connect the DB 2 ');    
		}else throw new Exception('Problem to connect the DB ');		
}






?>