<?php
//include 'awFunctions.php';
/*Ojo: el nick no se cambia, además si se hiciera habría que cambiarlo en Persona, ya que se la clave primaria*/
function updateEmpresa($con,$nick,$logo,$dir){

	$nick =mysqli_real_escape_string($con,$nick); 
	$dir =mysqli_real_escape_string($con,$dir); 
	//$logo =file_get_contents($logo);
	if($stmt = mysqli_prepare($con,"UPDATE  empresa set nick =? , logo=? , dir=? ,descrip=?  where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "ssss", $nick,$logo,$dir,$nick);

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

function updateEmpresa2($con,$nick,$dir){

	$nick =mysqli_real_escape_string($con,$nick); 
	$dir =mysqli_real_escape_string($con,$dir); 
	//$logo =file_get_contents($logo);
	if($stmt = mysqli_prepare($con,"UPDATE  empresa set nick =? , dir=?   where nick=? ")){
		 		
		 		/* ligar parámetros para marcadores, sss-> string ,string, string */
			    mysqli_stmt_bind_param($stmt, "sss", $nick,$dir,$nick);

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

function selectEmpresa($con){

	if($stmt = mysqli_prepare($con,"SELECT nick, dir FROM empresa ")){

		mysqli_stmt_execute($stmt);

		 /* vincular variables a la sentencia preparada */
	    mysqli_stmt_bind_result($stmt, $col1,$col2);

	    //otra forma de crear una tabla con los resultados.
	    echo "<table >
		<tr>
		<th>nick</th>
		<th>direction</th>
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
function deleteEmpresa($con,$nick){
		$nick =mysqli_real_escape_string($con,$nick); 
		if ($stmt = mysqli_prepare($con,"DELETE FROM empresa WHERE nick = ? ") ){
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
function insertEmpresa($con,$nick,$logo,$dir,$txt){
		
		
		$nick =mysqli_real_escape_string($con,$nick); 
		$dir =mysqli_real_escape_string($con,$dir);  
		//$logo=file_get_contents($logo);
		if ($stmt = mysqli_prepare($con,"INSERT INTO empresa (nick , logo ,dir,descrip) VALUES (? , ? , ? , ?)") ){

			    /* ligar parámetros para marcadores, sss-> string ,string, string, rellena los ? en el orden que se ponen  */
			    mysqli_stmt_bind_param($stmt, "ssss", $nick,$logo,$dir,$txt);

			    /* ejecutar la consulta */
			    $res=mysqli_stmt_execute($stmt);
			   //echo $res; 
			    /* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	//infoAds2($nick);
			    }else throw new Exception('Problem to connect the DB 2 ');    
		}else throw new Exception('Problem to connect the DB ');		
}


?>