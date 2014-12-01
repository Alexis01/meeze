<?php
		
	function insertEvento($con, $nombre, $descrip, $imagen, $fecha, $hora, $privacidad, $owner)
	{
		$nombre =mysqli_real_escape_string($con,$nombre); 
		$descrip =mysqli_real_escape_string($con,$descrip); 
		//$fecha = mysqli_real_escape_string($con,$fecha); 
		//$hora =mysqli_real_escape_string($con,$hora);
		//$fechaHora = $fecha." ".$hora;
		//$fechahora = strtotime($fechaHora);
		//$fechaHora = date ('Y-m-d H:i', $fechaHora);
		$privacidad =mysqli_real_escape_string($con,$privacidad); 
		$owner =mysqli_real_escape_string($con,$owner); 
		$imagen =mysqli_real_escape_string($con, $imagen); 
		//echo $fechaHora;
		
		if ($stmt = mysqli_prepare($con,"INSERT INTO evento (nombre,descrip,fecha,privacidad,owner,autorizado,imagen) VALUES (?,?,null,?,?,'0',null)"))
		{
			mysqli_stmt_bind_param($stmt, "sssss", $nombre,$descrip, $privacidad, $owner,$imagen);
			$res=mysqli_stmt_execute($stmt);
			    
		//hacer un else con un mensaje de error.
		/* cerrar sentencia */
		mysqli_stmt_close($stmt);	
		if($res==1){//1 = exito
			    	$msn = 'insert';
			    	infoAds($msn);
			    	return $res;
			    }else throw new Exception('Problem to connect the DB 2 ');    
		}else throw new Exception('Problem to connect the DB 4');
	}
	
	function insertEvento2($con, $nombre, $descrip, $privacidad, $owner)
	{
		$nombre =mysqli_real_escape_string($con,$nombre); 
		$descrip =mysqli_real_escape_string($con,$descrip); 
		$privacidad =mysqli_real_escape_string($con,$privacidad); 
		$owner =mysqli_real_escape_string($con,$owner); 
		
		if ($stmt = mysqli_prepare($con,"INSERT INTO evento (nombre,descrip,fecha,privacidad,owner,autorizado,imagen) VALUES (?,?,null,?,?,'0',null)"))
		{
			mysqli_stmt_bind_param($stmt, "ssss", $nombre,$descrip, $privacidad, $owner);
			$res=mysqli_stmt_execute($stmt);
			    
		//hacer un else con un mensaje de error.
		/* cerrar sentencia */
		mysqli_stmt_close($stmt);	
		if($res==1){//1 = exito
			    	$msn = 'insert';
			    	infoAds($msn);
			    	return $res;
			    }else throw new Exception('Problem to connect the DB 2 ');    
		}else throw new Exception('Problem to connect the DB 4');
	}


	function updateEvento ($con, $nombre, $descrip, $imagen, $fecha, $hora, $privacidad, $owner, $id)
	{
		$id =mysqli_real_escape_string($con,$id); 
		$nombre =mysqli_real_escape_string($con,$nombre); 
		$descrip =mysqli_real_escape_string($con,$descrip); 
		$fecha = mysqli_real_escape_string($con,$fecha); 
		$hora =mysqli_real_escape_string($con,$hora);
		$fehchaHora = $fecha.":".$hora;
		$privacidad =mysqli_real_escape_string($con,$privacidad); 
		$owner =mysqli_real_escape_string($con,$owner); 
		$imagen =mysqli_real_escape_string($con,$imagen); 
		
		if ($stmt = mysqli_prepare($con,"UPDATE evento SET nombre=?, descrip=?, fecha=?, privacidad=? WHERE id =$id"))
		{
			mysqli_stmt_bind_param($stmt, "ssis", $nombre,$descrip,$fechaHora, $privacidad);
			 $res=mysqli_stmt_execute($stmt);
			 mysqli_stmt_close($stmt);
			    if($res==1){
			    	$msn = 'update';
			    	infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');
	}
	
	//Permite al administrador autorizar un evento solicitado
	function autorizarEvento ($con, $id)//ok
	{
		$id =mysqli_real_escape_string($con,$id); 
		
		if ($stmt = mysqli_prepare($con, "UPDATE evento SET autorizado='1' WHERE id =?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $id);
			/* ejecutar la consulta */
			    $res=mysqli_stmt_execute($stmt);   
				/* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	$msn = 'autorizacion';
			    	infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');
		
	}
	
	function deleteEvento ($con, $id)//ok
	{
		$id =mysqli_real_escape_string($con,$id); 
		
		if ($stmt = mysqli_prepare($con, "DELETE FROM evento WHERE id =?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $id);
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
	
	/*si un determinado evento pertenece a dicha empreas o no*/
	function perteneceEventoEmpresa ($con, $nick,$id)
	{
		if($stmt = mysqli_prepare($con,"SELECT id FROM evento WHERE evento.owner = ?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $nick);
			mysqli_stmt_execute($stmt);

			 /* vincular variables a la sentencia preparada */
			mysqli_stmt_bind_result($stmt, $col1);

			/*pasar el resultado a las variables de la sentencia */
		    mysqli_stmt_fetch($stmt);
	    	
		    /* cerrar la $stmt */
    		mysqli_stmt_close($stmt);

		    /*comprobamos que coinciden, necesitamos solo 1 comprob, ya que todo se filtra en la consulta*/	
		    $coin = strcmp($id,$col1);
		    if($coin ==0){		    	
		    		return true;
			}else throw new Exception('event does not exist') ;
		}else throw new Exception('Problem to connect the DB ');
	}


	//Muestra los eventos de una empresa
	function selectEventoEmpresa ($con, $nick)//ok
	{
		if($stmt = mysqli_prepare($con,"SELECT nombre,id FROM evento WHERE evento.owner = ?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $nick);
			mysqli_stmt_execute($stmt);

			 /* vincular variables a la sentencia preparada */
			mysqli_stmt_bind_result($stmt, $col1,$col2);

			//otra forma de crear una tabla con los resultados.
			echo "<table >
			<tr>
			<th>nombre</th>
			<th>Id evento</th>
			</tr>";
			 /* obtener valores */
			while (mysqli_stmt_fetch($stmt)) {
				 echo "<tr>";
				  echo "<td>" . $col1. "</td>";
				  echo "<td>" . $col2. "</td>";
				 echo "</tr>";	
			}
			 echo "</table>";

			/* cerrar la $stmt */
			mysqli_stmt_close($stmt);
		}else throw new Exception('Problem to connect the DB ');
	}
		
	function checkExistEvento($con, $id)//ok
	{
		if($stmt = mysqli_prepare($con,"SELECT id FROM evento WHERE evento.id = ?"))
		{
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);

			 /* vincular variables a la sentencia preparada */
			mysqli_stmt_bind_result($stmt, $col1);

			 /*pasar los valores a $res*/
			  mysqli_stmt_fetch($stmt);

			    /*cerramos stmt*/
			    mysqli_stmt_close($stmt);
			   
			    
			    if($id==$col1){
			    	return True;
			    }else return FALSE;

		}else throw new Exception('Problem to connect the DB ');
	}



	//muestra los eventos segun su autorizacion
	function selectEventoAutorizacion ($con, $autorizado)//ok
	{
		$autorizado =mysqli_real_escape_string($con,$autorizado);
		
		if($stmt = mysqli_prepare($con,"SELECT nombre, empresa.nick,id FROM evento,empresa WHERE autorizado=? AND evento.owner = empresa.nick"))
		{	
		 mysqli_stmt_bind_param($stmt, "s", $autorizado);
		mysqli_stmt_execute($stmt);

		 /* vincular variables a la sentencia preparada */
		mysqli_stmt_bind_result($stmt, $col1,$col2,$col3);

		//otra forma de crear una tabla con los resultados.
		echo "<table >
		<tr>
		<th>Nombre</th>
		<th>Empresa</th>
		<th>Id Evento</th>
		</tr>";
		 /* obtener valores */
		while (mysqli_stmt_fetch($stmt)) {
			 echo "<tr>";
			  echo "<td>" . $col1. "</td>";
			  echo "<td>" . $col2. "</td>";
			  echo "<td>" . $col3. "</td>";
			  echo "</tr>";	
		}
		 echo "</table>";

		/* cerrar la $stmt */
		mysqli_stmt_close($stmt);
		}else throw new Exception('Problem to connect the DB ');
	}
	
	//eventos apuntado por un usuario
	function selectEventoAsistir($con, $nick)//ok
	{
	//Cambiar
		$nick =mysqli_real_escape_string($con,$nick);
		if($stmt=mysqli_prepare($con,"SELECT evento.nombre, evento.owner FROM evento, reg_eventos WHERE evento.id=reg_eventos.evento AND reg_eventos.usuario = ?"))
		{
		mysqli_stmt_bind_param($stmt, "s", $nick);
		mysqli_stmt_execute($stmt);

		 /* vincular variables a la sentencia preparada */
		mysqli_stmt_bind_result($stmt, $col1,$col2);
		$calendario="calendarioV2";
		$objects="objectsId";
		$cabecera="cabtableid";
		//otra forma de crear una tabla con los resultados.
		echo "<table id=".$calendario.">
		<tr id=".$cabecera.">
		<th>Nombre Evento</th>
		<th>Empresa</th>
		</tr>";
		 /* obtener valores */
		while (mysqli_stmt_fetch($stmt)) {
			 echo "<tr id=".$objects.">";
			  echo "<td>" . $col1. "</td>";
			  echo "<td>" . $col2. "</td>";
			  echo "</tr>";	
		}
		 echo "</table>";

		/* cerrar la $stmt */
		mysqli_stmt_close($stmt);
		}else throw new Exception('Problem to connect the DB ');
	}
	
	function insertUserEvento($con, $usuario, $evento)//ok
	{
		$usuario =mysqli_real_escape_string($con,$usuario); 
		$evento =mysqli_real_escape_string($con,$evento); 
		
		//$imagen =file_get_contents($imagen); 
		
		if ($stmt = mysqli_prepare($con,"INSERT INTO reg_eventos (usuario,evento) VALUES (?,?)"))
		{
			mysqli_stmt_bind_param($stmt, "si", $usuario,$evento);
			 $res=mysqli_stmt_execute($stmt);
			    
			//hacer un else con un mensaje de error.
			/* cerrar sentencia */
			mysqli_stmt_close($stmt);	
			if($res==1){//1 = exito
						//$msn = 'insert';
						//infoAds($msn);
					}else throw new Exception('Problem to insert user in event ');    
		}else throw new Exception('Problem to connect the DB ');
	}
	
	function deleteEventoUser ($con, $evento,$nick)//ok
	{
		$evento =mysqli_real_escape_string($con,$evento); 
		$nick =mysqli_real_escape_string($con,$nick);
		if ($stmt = mysqli_prepare($con, "DELETE FROM reg_eventos WHERE evento =? AND usuario=?"))
		{
			mysqli_stmt_bind_param($stmt, "is", $evento,$nick);
			/* ejecutar la consulta */
			    $res=mysqli_stmt_execute($stmt);   
				/* cerrar sentencia */
				mysqli_stmt_close($stmt);
				if($res==1){//1 = exito
			    	//$msn = 'delete';
			    	//infoAds($msn);
			    }else throw new Exception('Problem to connect the DB ');
		}else throw new Exception('Problem to connect the DB ');
		
	}
?>