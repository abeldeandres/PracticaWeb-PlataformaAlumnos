<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	//@$idUsuarioAdmin  = $_SESSION['idUsuario'];
	//Recuperamos de post
	@$nombre     = $_POST['nombre'];
	@$descripcion    = $_POST['descripcion'];

	//Proteccion por si las contraseñas no coinciden
		//Primero comporbamos que no existe repetido
		$consulta ='SELECT * FROM tGrupo where nombre = "'.$nombre.'"';
		$linea = RealizarConsultaBD($consulta);
		if($linea!=FALSE){		
			if($linea['nombre']==$nombre){
				$_SESSION['mensaje']="Nombre del grupo repetido";
				$_SESSION['correcto']=FALSE;
			}
		}
		else{
			//INSERT INTO `tusuario`(`idUsuario`, `nombre`, `pass`, `correo`, `esAdmin`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
			$consulta = "INSERT INTO `tgrupo` (`nombre`, `descripcion`)";
			$consulta = $consulta." VALUES ('".$nombre."', '".$descripcion."');";
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
	header('Location: crear_grupo.php');
?>