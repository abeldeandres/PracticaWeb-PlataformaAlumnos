<?php 
	//Funcion que realiza la consulta y devuelve un REQUEST
	function realizaConsultaCompleta($consulta){
		//Definimos algunas variables globales para el acceso a la base de datos
		@$SERVIDOR_MYSQL = 'localhost';//'rdbms.strato.de';
		@$USUARIO_MYSQL  = 'usuario';  //'U1520750';
		@$PASS_MYSQL     = '148240';
		@$BBDD_MYSQL     = 'bd_abel';  //"DB1520750";
		//Establecemos comunicacion con el servidor MySQL
		@$coneccion = mysql_connect($SERVIDOR_MYSQL,$USUARIO_MYSQL,$PASS_MYSQL);
		if ($coneccion) {//Si se ha podido conectar
			if(mysql_select_db($BBDD_MYSQL,$coneccion)){//Si se ha podido seleccionar la base BD
				$respuesta = mysql_query($consulta,$coneccion);
				mysql_close($coneccion);
				return $respuesta;
			}
			else{
				echo 'La base de datos <b>'.$BBDD_MYSQL.'</b> No existe<br />';
			}
			mysql_close($coneccion);
		}
		else{
			die('NO HA PODIDO CONECTARSE AL SERVIDOR MySQL '.mysql_error());
		}
		return FALSE;
	}
	
	//Funcion que se conecta a la BD y envia una Consulta
	function RealizarConsultaBD($consulta){
		$respuesta = realizaConsultaCompleta($consulta);
		if($respuesta!=FALSE){
			$linea = mysql_fetch_assoc($respuesta);
			return $linea;
		}
		else return FALSE;
	}
		
	//Devulve los datos de un usuario existente
	function obtenerUsuario($idUsuario){
		$consulta ='SELECT * FROM tUsuario where idUsuario = "'.$idUsuario.'"';
		$linea = RealizarConsultaBD($consulta);
		return $linea;
	}
	function obtenerUsuarioConPass($idUsuario,$pass_form){
		$consulta ='SELECT * FROM tUsuario where idUsuario = "'.$idUsuario.'" AND pass = "'.$pass_form.'"';
		//echo $consulta."<br>";
		$linea = RealizarConsultaBD($consulta);
		return $linea;	
	}
	function obtenerGrupo($idGrupo){
		$consulta ='SELECT * FROM tGrupo where idGrupo = '.$idGrupo;
		$linea = RealizarConsultaBD($consulta);
		return $linea;
	}
	function obtenerTodosLosUsuarios(){
		$consulta ='SELECT * FROM tUsuario'; 
		return realizaConsultaCompleta($consulta);
	}
	function obtenerContenidosPublicos(){
		$consultaAux ='SELECT * FROM tRecursos WHERE esPublico = 1';
		
		$consulta  = 'SELECT tRecursos.* ,tReuniones.idGrupo ';
		$consulta .= 'FROM  tReuniones, tRecursos ';	
		$consulta .= 'WHERE tRecursos.esPublico    = 1 ';
		$consulta .= 'AND   tReuniones.idReuniones = tRecursos.idReuniones ';
		return realizaConsultaCompleta($consulta);
	}
	function obtenerContenidosPrivado($idUsuario){		
		$consulta  = 'SELECT tRecursos.* ,tMiembro.idGrupo ';
		$consulta .= 'FROM tMiembro, tReuniones, tRecursos ';
		$consulta .= 'WHERE tMiembro.idUsuario     = "'.$idUsuario.'" ';
		$consulta .= 'AND   tMiembro.idGrupo       = tReuniones.idGrupo ';		
		$consulta .= 'AND   tReuniones.idReuniones = tRecursos.idReuniones ';
		$consulta .= 'AND   tRecursos.esPublico    = 0;';
		return realizaConsultaCompleta($consulta);
	}
	function obtenerTodosLosGrupos(){
		$consulta ='SELECT * FROM tGrupo'; 
		return realizaConsultaCompleta($consulta);
	}
	function obtenerTodosLosUsuariosDeUnGrupo($idGrupo){
		$consulta ='SELECT * FROM tMiembro where idGrupo = '.$idGrupo;
		$listaUsuarios = realizaConsultaCompleta($consulta);
		return $listaUsuarios;
	}
	function obtenerTodosLosUsuariosQueNoEstanGrupo($idGrupo){
		$consulta = 'SELECT * FROM tusuario WHERE tusuario.idUsuario not in'; 
		$consulta = $consulta.'(Select tmiembro.idUsuario FROM tmiembro WHERE tmiembro.idGrupo='.$idGrupo.')';
		$listaUsuarios = realizaConsultaCompleta($consulta);
		return $listaUsuarios;
	}
	function agregarMiembroAGrupo($idUsuario,$idGrupo){
		$consulta = "INSERT INTO `tmiembro` (`idUsuario`, `idGrupo`)";
		$consulta = $consulta." VALUES ('".$idUsuario."', '".$idGrupo."');";	
		$res = realizaConsultaCompleta($consulta);
		return $res;
	}
	function eliminarMiembroDeGrupo($idUsuario,$idGrupo){
		/*
		DELETE FROM `bd_abel`.`tmiembro` WHERE `tmiembro`.`idUsuario` = 'admin' AND `tmiembro`.`idGrupo` = 9999
		*/
		$consulta = "DELETE FROM `bd_abel`.`tmiembro` WHERE ";
		$consulta .= " `tmiembro`.`idUsuario` = '".$idUsuario."' AND ";
		$consulta .= " `tmiembro`.`idGrupo` = ".$idGrupo;
		$res = realizaConsultaCompleta($consulta);
		return $res;
	}
	function modificarGrupo($idGrupo,$descripcion,$nombre){
		/*
		UPDATE  `bd_abel`.`tgrupo` SET  `nombre` =  'Proyecto Mac', `descripcion`='nasdasad' WHERE  `tgrupo`.`idGrupo` =9999;
		*/
		$consulta = "UPDATE  `bd_abel`.`tgrupo` SET ";
		$consulta .= " `nombre` = '".$nombre."', ";
		$consulta .= " `descripcion` = '".$descripcion."' ";
		$consulta .= " WHERE `tgrupo`.`idGrupo` = ".$idGrupo;
		$res = realizaConsultaCompleta($consulta);
		return $res;
	}
	function eliminarGrupo($idGrupo){
		/*
		DELETE  FROM `bd_abel`.`tgrupo` WHERE  `tgrupo`.`idGrupo` =9999;
		*/
		$consulta = "DELETE  FROM `bd_abel`.`tgrupo` WHERE";
		$consulta .= " `tgrupo`.`idGrupo` = ".$idGrupo."; ";
		realizaConsultaCompleta($consulta);
		
		/*
		DELETE FROM `bd_abel`.`tmiembro` WHERE `tmiembro`.`idGrupo` = 9999 LIMIT 1;
		*/
		$consulta = "DELETE FROM `bd_abel`.`tmiembro` WHERE ";
		$consulta .= " `tmiembro`.`idGrupo` = ".$idGrupo."; ";
		realizaConsultaCompleta($consulta);
	}
	function agregarResponsable($idGrupo,$idJefe){
		/*
		UPDATE  `bd_abel`.`tgrupo` SET  `idJefe` =  'nuevo jef' WHERE  `tgrupo`.`idGrupo` =9999;
		*/	
		$consulta = "UPDATE  `bd_abel`.`tgrupo` SET ";
		$consulta .= " `idJefe` =  '".$idJefe."' ";
		$consulta .= " WHERE `tgrupo`.`idGrupo` = ".$idGrupo."; ";
		realizaConsultaCompleta($consulta);
	}
	function obtenerTodosLosGruposJefe($idJefe){
		$consulta ="SELECT * FROM tGrupo WHERE `tgrupo`.`idJefe` = '".$idJefe."';"; 
		return realizaConsultaCompleta($consulta);
	}
	function obtenerTodosLosGruposDelQueEsMiembro($idUsuario){
		$consulta ="SELECT * FROM tMiembro WHERE `tmiembro`.`idUsuario` = '".$idUsuario."';"; 
		return realizaConsultaCompleta($consulta);	
	}
	function esResponsable($idUsuario){
		$listaGrupos = obtenerTodosLosGruposJefe($idUsuario);
		$i=0;
		while($fila = mysql_fetch_array($listaGrupos)){
			$i++;
		}
		mysql_free_result($listaGrupos);
		if($i>0) return TRUE;
		else return FALSE;	
	}
	function esMiembro($idUsuario){
		$listaGrupos = obtenerTodosLosGruposDelQueEsMiembro($idUsuario);
		$i=0;
		while($fila = mysql_fetch_array($listaGrupos)){
			$i++;
		}
		mysql_free_result($listaGrupos);
		if($i>0) return TRUE;
		else return FALSE;	
	}
	
	function obtenerTodasLasReuniones($idUsuario){
		$consulta = "SELECT * FROM tReuniones WHERE tReuniones.idGrupo in ";
		$consulta .= "(SELECT tMiembro.idGrupo FROM tMiembro WHERE tMiembro.idUsuario = '".$idUsuario."');";
		return realizaConsultaCompleta($consulta);		
	}
	function obtenerTodasLasReunionesDeGrupo($idGrupo){
		$consulta = 'SELECT * FROM tReuniones WHERE tReuniones.idGrupo = "'.$idGrupo.'";';
		return realizaConsultaCompleta($consulta);		
	}
	function convocarReunion($idGrupo,$fecha,$descripcion){
		/*
		INSERT INTO `bd_abel`.`treuniones` (`idReuniones`, `fecha`, `descripcion`, `idGrupo`) VALUES (NULL, '2014-01-16', 'asdasdasdasd', '10000');
		*/
		$consulta = "INSERT INTO tReuniones (fecha,descripcion,idGrupo) VALUES (";
		$consulta .= "'".$fecha."', '".$descripcion."', '".$idGrupo."');";
		return realizaConsultaCompleta($consulta);		
	}
	function crearContenido($ruta,$nombre,$descripcion,$visibilidad,$idReuniones){
		/*
		INSERT INTO `bd_abel`.`treuniones` (`idReuniones`, `fecha`, `descripcion`, `idGrupo`) VALUES (NULL, '2014-01-16', 'asdasdasdasd', '10000');
		*/
		$consulta = "INSERT INTO tRecursos (ruta,nombre,descripcion,esPublico,idReuniones) VALUES ";
		$consulta .= "('".$ruta."', '".$nombre."', '".$descripcion."', ".$visibilidad.", ".$idReuniones.");";
		return realizaConsultaCompleta($consulta);
	}
	function obtenerReunion($idReuniones){
		$consulta ='SELECT * FROM treuniones where idReuniones = '.$idReuniones;
		$linea = RealizarConsultaBD($consulta);
		return $linea;
	}
	function modificarReunion($idReuniones,$descripcion,$fecha){
		/*
		UPDATE  `bd_abel`.`tgrupo` SET  `nombre` =  'Proyecto Mac', `descripcion`='nasdasad' WHERE  `tgrupo`.`idGrupo` =9999;
		*/
		$consulta = "UPDATE  `bd_abel`.`treuniones` SET ";
		$consulta .= " `fecha` = '".$fecha."', ";
		$consulta .= " `descripcion` = '".$descripcion."' ";
		$consulta .= " WHERE `treuniones`.`idReuniones` = ".$idReuniones;
		$res = realizaConsultaCompleta($consulta);
		return $res;
	}
	function eliminarReunion($idReuniones){
		/*
		DELETE  FROM `bd_abel`.`tgrupo` WHERE  `tgrupo`.`idGrupo` =9999;
		*/
		$consulta = "DELETE  FROM `bd_abel`.`treuniones` WHERE";
		$consulta .= " `treuniones`.`idReuniones` = ".$idReuniones."; ";
		realizaConsultaCompleta($consulta);

		$consulta = "DELETE  FROM `bd_abel`.`trecursos` WHERE";
		$consulta .= " `trecursos`.`idReuniones` = ".$idReuniones."; ";
		realizaConsultaCompleta($consulta);
	}
?>