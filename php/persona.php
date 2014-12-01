<?php

//NOTA: En la tabla persona NO se guarda la contraseña en sí, sino una md5 de ella. 

/*comprueba que un usuario exista con ese nick y pass , en caso ok , devuelve un array con sus datos*/
function selectLogUsr($con,$usr,$pass){

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
		    }else throw new Exception('user/password incorrect (selectLogUsr)') ;
	}else throw new Exception('Problem to connect the DB ');
  
}

function selectcorreo($con,$usr){

	/*si todo va bien*/
	if($stmt = mysqli_prepare($con,"SELECT correo FROM persona where nick =?  " )){

			/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "s", $usr);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    
		    	    	
		    		/*Si todo va bien obtenemos TODO relativo al usuario y lo devolvemos*/
		    		$res =$col1;
		    		/*Devolvemos el resultado*/
    				return $res; 	
		 
	}else throw new Exception('Problem to connect the DB ');
  
}



/*Inserta una persona*/
function insertPesona($con,$nick,$pass,$correo,$id){
		
		
		$nick =mysqli_real_escape_string($con,$nick); 
		$pass =mysqli_real_escape_string($con,$pass); 
		$correo =mysqli_real_escape_string($con,$correo);
		//$id =mysqli_real_escape_string($con,$id);
		
		if ($stmt = mysqli_prepare($con,"INSERT INTO persona (nick , pass ,correo,id_perfil) VALUES (? , ? , ?, ?)") ){

			    /* ligar parámetros para marcadores, sss-> string ,string, string, rellena los ? en el orden que se ponen  */
			    mysqli_stmt_bind_param($stmt, "sssi", $nick,$pass,$correo,$id);

			    /* ejecutar la consulta */
			    $res=mysqli_stmt_execute($stmt);
			     
			    /* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	//$msn = 'registration has been succesful, Welcome !';
			    	infoAds2($nick);
			    }else throw new Exception('Problem to connect the DB 3 ');    
		}else throw new Exception('Problem to connect the DB ');		
}


//Estilo por procedimientos(No orientado a objetos)
function deletePersona($con,$nick){
		$nick =mysqli_real_escape_string($con,$nick); 
		if ($stmt = mysqli_prepare($con,"DELETE FROM persona WHERE nick = ? ") ){
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

function updateCorreo($con,$nick,$correo){
	$nick =mysqli_real_escape_string($con,$nick); 
	$correo =mysqli_real_escape_string($con,$correo); 
	//$pass =file_get_contents($pass);
	if($stmt = mysqli_prepare($con,"UPDATE  persona set correo=?  where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "ss", $correo,$nick);

			    /* ejecutar la consulta */
			    $res= mysqli_stmt_execute($stmt);
			    /*cerramos stmt*/
			    mysqli_stmt_close($stmt);
			    if($res==1){
			    	//$msn = 'update';
			    	//infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');
}

function updatePass($con,$nick,$pass){

	$nick =mysqli_real_escape_string($con,$nick); 
	$correo =mysqli_real_escape_string($con,$pass); 
	//$pass =file_get_contents($pass);
	if($stmt = mysqli_prepare($con,"UPDATE  persona set  pass=?  where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "ss", $pass,$nick);

			    /* ejecutar la consulta */
			    $res= mysqli_stmt_execute($stmt);
			    /*cerramos stmt*/
			    mysqli_stmt_close($stmt);
			    if($res==1){
			    	//$msn = 'update';
			    	//infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');
}

function updatePersona($con,$nick,$correo,$pass){

	$nick =mysqli_real_escape_string($con,$nick); 
	$correo =mysqli_real_escape_string($con,$correo); 
	//$pass =file_get_contents($pass);
	if($stmt = mysqli_prepare($con,"UPDATE  persona set  pass=? , correo=? where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "sss", $pass,$correo,$nick);

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


/*Nos devuelve los 2 param de persona que podemos modificar y el nick para comprobar que la consulta es correcta*/
function selectPersona($con,$usr){

	/*si todo va bien*/
	if($stmt = mysqli_prepare($con,"SELECT correo,pass,nick FROM persona where nick =?  " )){

			/*sustituimo ? por los parametros*/
			mysqli_stmt_bind_param($stmt, "s", $usr);

			/*Ejecutar sentencia*/
			mysqli_stmt_execute($stmt);
			
			/* vincular variables a la sentencia preparada */
		    mysqli_stmt_bind_result($stmt, $col1,$col2,$col3);
		    
		    /*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($usr,$col3);
		    if($coin ==0){		    	
		    		/*Si todo va bien obtenemos TODO relativo al usuario y lo devolvemos*/
		    		$res =["correo"=>$col1,"pass"=>$col2 ];
		    		 /*Devolvemos el resultado*/
    				 return $res; 	
		    }else throw new Exception('user/password incorrect') ;
	}else throw new Exception('Problem to connect the DB ');
  
}









?>