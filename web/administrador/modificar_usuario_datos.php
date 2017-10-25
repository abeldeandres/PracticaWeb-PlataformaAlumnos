<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	//@$idUsuarioAdmin  = $_SESSION['idUsuario'];
	//Recuperamos de post
	//@$idUsuario  = $_SESSION['idUsuario'];
	@$idUsuario  = $_POST['idUsuario_form'];
	@$nombre     = $_POST['nombre_form'];
	@$correo     = $_POST['correo_form'];
	@$pass       = $_POST['pass_form'];
	@$boton      = $_POST['boton'];
	
	
	if($boton!='Eliminar'){ 
		$consulta = "UPDATE tusuario SET nombre='".$nombre."', pass='".$pass."', correo='".$correo."'  WHERE idUsuario = '".$idUsuario."'";
		$linea = realizaConsultaCompleta($consulta);
		
		if($linea>0){
			$_SESSION['correcto']=TRUE;
			$_SESSION['mensaje']="Se ha modificado Correctamente";
		}
		else{
			$_SESSION['correcto']=FALSE;
			$_SESSION['mensaje']="Hay monos en el sistema que no deja insertar usuarios";
		}
		
	}
	else{
		$consulta = "DELETE FROM tusuario WHERE idUsuario = '".$idUsuario."'";
		$linea = realizaConsultaCompleta($consulta);
		if($linea>0){
			$_SESSION['correcto']=TRUE;
			$_SESSION['mensaje']="Se ha eliminado correctamente";
		}
		else{
			$_SESSION['correcto']=FALSE;
			$_SESSION['mensaje']="Hay monos en el sistema que no deja insertar usuarios";
		}
	}
	header('Location: modificar_usuario.php');
?>