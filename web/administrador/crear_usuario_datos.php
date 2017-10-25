<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	//@$idUsuarioAdmin  = $_SESSION['idUsuario'];
	//Recuperamos de post
	@$idUsuario  = $_POST['idUsuario'];
	@$nombre     = $_POST['nombre'];
	@$correo     = $_POST['correo'];
	@$pass       = $_POST['pass'];
	@$pass1      = $_POST['pass1'];

	//Proteccion por si las contraseñas no coinciden
	if($pass == $pass1 && $pass!=''){
		//Primero comporbamos que no existe repetido
		$consulta ='SELECT * FROM tUsuario where idUsuario = "'.$idUsuario.'"';
		$linea = RealizarConsultaBD($consulta);
		if($linea!=FALSE){		
			if($linea['idUsuario']==$idUsuario){
				$_SESSION['mensaje']="ID del usuario repetido";
				$_SESSION['correcto']=FALSE;
			}
		}
		else{
			//INSERT INTO `tusuario`(`idUsuario`, `nombre`, `pass`, `correo`, `esAdmin`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
			$consulta = "INSERT INTO `tusuario` (`idUsuario`, `nombre`, `pass`, `correo`)";
			$consulta = $consulta." VALUES ('".$idUsuario."', '".$nombre."', '".$pass."', '".$correo."');";
			$linea = realizaConsultaCompleta($consulta);
			if($linea!=FALSE){
				$_SESSION['correcto']=TRUE;
				$_SESSION['mensaje']="Se ha Agregado Correctamente";
			}
			else{
				$_SESSION['correcto']=FALSE;
				$_SESSION['mensaje']="Hay monos en el sistema que no deja insertar usuarios";
			}
		}
	}
	else if($pass == $pass1){
		$_SESSION['mensaje']='Debe especificar una contraseña';
		$_SESSION['correcto']=FALSE;
	}
	else{
		$_SESSION['mensaje']='Contraseñas no coinciden';
		$_SESSION['correcto']=FALSE;
	}
	header('Location: crear_usuario.php');
?>