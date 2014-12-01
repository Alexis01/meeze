<?php


function selectLogUsr2($con,$usr,$pass){

	/*si todo va bien*/
	if($stmt = mysqli_prepare($con,"SELECT * FROM persona where nick =? and pass=? " )){

			/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "ss", $usr,$pass);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1,$col2,$col3,$col4);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($usr,$col1);
		    if($coin ==0){		    	
		    		/*Si todo va bien obtenemos TODO relativo al usuario y lo devolvemos*/
		    		$res =["nick"=>$col1,"pass"=>$col2,"correo"=>$col3,"id_perfil"=>$col4 ];
		    		 /*Devolvemos el resultado*/
    				 return $res; 	
		    }else throw new Exception('user/password incorrect') ;
	}else throw new Exception('Problem to connect the DB ');
  
}
	
?>