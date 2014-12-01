<?php
//Documento con las funciones relativas al manejo de comentarios

function insertComment($con, $nick, $txt, $event){
//esta función insertará el el comentario de un usuario en un evento específico
	
	
		//se introducirá la tupla (user, evento, txt) en la tabla comentarios_evento
		$nick =mysqli_real_escape_string($con,$nick); // se pueden sobreescribir????????
		$txt =mysqli_real_escape_string($con,$txt);  
		$event =mysqli_real_escape_string($con,$event);  
		
		if ($stmt = mysqli_prepare($con,"INSERT INTO comentarios_evento (usuario, evento, valor) VALUES (? , ? , ?)") ){
			
			     mysqli_stmt_bind_param($stmt, "sis", $nick, $event, $txt);
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

function deleteComment($con, $id){

		$id =mysqli_real_escape_string($con,$id); 
		if ($stmt = mysqli_prepare($con,"DELETE FROM comentarios_evento WHERE id = ? ") ){

			    /* ligar parámetros para marcadores, isss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "i",   $id);

			    /* ejecutar la consulta */
			  $res=mysqli_stmt_execute($stmt);   
				/* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	$msn = 'delete';
			    	infoAds($msn);
			    }else throw new Exception('Problem to connect the DB 2');
		}else throw new Exception('Problem to connect the DB ');
}

function selectCommentsEventos($con, $evento){

	$evento =mysqli_real_escape_string($con,$evento);
	if($stmt = mysqli_prepare($con,"SELECT valor, fecha, usuario FROM comentarios_evento WHERE evento=?")){
		mysqli_stmt_bind_param($stmt, "i",   $evento);
		
		mysqli_stmt_execute($stmt);

		 /* vincular variables a la sentencia preparada */
	    mysqli_stmt_bind_result($stmt, $col1,$col2,$col3);

	    //otra forma de crear una tabla con los resultados.
	    echo "<table >
		<tr>
		<th>valor</th>
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