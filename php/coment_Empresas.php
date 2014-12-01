<?php
//Documento con las funciones relativas al manejo de comentarios

function insertCommentEmpresa($con, $nick, $txt, $empresa){
//esta función insertará el el comentario de un usuario en un evento específico
	
	//es necesario comprobar que hay conexión
	//if (mysqli_connect_errno()) {   
		//throw new Exception('No se ha establecido la conexión.');   }
	
	//else{
		//se introducirá la tupla (user, evento, txt) en la tabla comentarios_empresa
		$nick =mysqli_real_escape_string($con,$nick); // se pueden sobreescribir????????
		$txt =mysqli_real_escape_string($con,$txt);  
		$empresa =mysqli_real_escape_string($con,$empresa);  
		//$hora = date('h:i a',time() - 3600*date('I')); //no se si sera asi
		
			if ($stmt = mysqli_prepare($con,"INSERT INTO comentarios_empresa (usuario, empresa, valor) VALUES (? , ? , ?)") ){
			
			     mysqli_stmt_bind_param($stmt, "sss", $nick,$empresa,$txt);
			    // ligar parámetros para marcadores, ssis-> string ,string,date,string, rellena los ? en el orden que se ponen  

			    /* ejecutar la consulta */
			   $res=mysqli_stmt_execute($stmt);   
				/* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	$msn = 'insert';
			    	infoAds($msn);
			    }else throw new Exception('Problem to connect the DB 2');
		}else throw new Exception('Problem to connect the DB ');
}

function deleteCommentEmpresa($con, $id){

		$id =mysqli_real_escape_string($con,$id); 
		if ($stmt = mysqli_prepare($con,"DELETE FROM comentarios_empresa WHERE id = ? ") ){

			    /* ligar parámetros para marcadores, isss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "i",   $id);

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

function selectCommentsEmpresa($con,$empresa){

	$empresa =mysqli_real_escape_string($con,$empresa); 
	if($stmt = mysqli_prepare($con,"SELECT valor, fecha, usuario FROM comentarios_empresa WHERE empresa=?")){
		 mysqli_stmt_bind_param($stmt, "i",$empresa);
		mysqli_stmt_execute($stmt);

		 /* vincular variables a la sentencia preparada */
	    mysqli_stmt_bind_result($stmt, $col1,$col2,$col3);

	    //otra forma de crear una tabla con los resultados.
	    echo "<table >
		<tr>
		<th>texto</th>
		<th>fecha</th>
		<th>usuario</th>
		</tr>";
	     /* obtener valores */
	    while (mysqli_stmt_fetch($stmt)) {
	         echo "<tr>";
			  echo "<td>" . $col1. "</td>";
			  echo "<td>" . $col2 . "</td>";
			   echo "<td>" . $col3 . "</td>";
			  echo "</tr>";	
	    }
	     echo "</table>";
	    /* cerrar la $stmt */
   		mysqli_stmt_close($stmt);
 	}else throw new Exception('Problem to connect the DB ');


}



?>