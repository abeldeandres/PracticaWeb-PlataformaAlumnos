<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$idUsuario  = $_SESSION['idUsuario'];
	@$nombre     = $_POST['nombre'];
	@$correo     = $_POST['correo'];
	@$pass       = $_POST['pass'];
	@$pass1      = $_POST['pass1'];
	@$pass2      = $_POST['pass2'];
	
	$consulta ='SELECT * FROM tUsuario where idUsuario = "'.$idUsuario.'"';
	$linea = RealizarConsultaBD($consulta);
	if($linea!=FALSE){
		if($linea['pass']==$pass){
			if($pass1 == $pass2){
				//Aqui modificar tabla
				if($pass1!='') $pass=$pass1;
				$consulta = "UPDATE `tusuario` SET `nombre`='".$nombre."', `pass`='".$pass."', `correo`='".$correo."' ";
				$consulta = $consulta." WHERE idUsuario = '".$idUsuario."';";
				$linea = realizaConsultaCompleta($consulta);
				if($linea!=FALSE){
					$_SESSION['mensaje']="Datos guardados correctamente";
					$_SESSION['correcto']=TRUE;
				}
				else{
					$_SESSION['correcto']=FALSE;
					$_SESSION['mensaje']="Hay monos en el sistema que no dejan actualizar tus datos";
				}
			}
			else{
				$_SESSION['correcto']=FALSE;
				$_SESSION['mensaje']="La contraseñas nuevas no coinciden";
			}
		}
		else{			
			$_SESSION['correcto']=FALSE;
			$_SESSION['mensaje']="La contraseña no es correcta";
		}
		header('Location: configuracion.php');
	}
	else header('Location: ../index.php');//a ocurrido fallo en el servidor
?>