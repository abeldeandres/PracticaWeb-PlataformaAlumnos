<?php include("misFuncionesMySQL.php");?>
<?php include("misFuncionesUtil.php");?>
<?php 
	session_start();//Establece una sesion
	@$numIntentos=$_SESSION['intentos'];
	
	@$idUsuario_form  = $_POST['idUsuario'];
	@$pass_form       = $_POST['pass'];
	@$boton_form      = $_POST['boton'];
	@$pagina;
	
	if($boton_form=="Invitado"){
		$_SESSION['idUsuario'] = "Invitado";
		$_SESSION['nombre']    = "Anónimo";
		$pagina="usuario/index_usuario.php";
	}
	else if(!isset($numIntentos) || $numIntentos<3){
		if(!isset($numIntentos)) $numIntentos=1;
		else $numIntentos++;
		$_SESSION['intentos']=$numIntentos;
		$linea = obtenerUsuarioConPass($idUsuario_form,$pass_form);
		if($linea!=false){//Usuario existe	
			//Si el usuario existe se crea sesion.........
			$_SESSION['idUsuario'] = $linea['idUsuario'];
			$_SESSION['nombre']    = $linea['nombre'];
			if($linea['esAdmin']==1){
				$pagina='administrador/index_administrador.php';
			}
			else if(esResponsable($idUsuario_form)){
				$pagina ='responsable/index_responsable.php';
			}
			else if(esMiembro($idUsuario_form)){
				$pagina='miembro/index_miembro.php';
			}
		}
		else{//No coinciden contraseña o usuario
			$_SESSION['mensaje']="Usuario o contraseña no válido, intento: ".$numIntentos;
			$pagina='index.php';	
		}
	}
	else{
		$_SESSION['idUsuario'] = "Invitado";
		$_SESSION['nombre']    = "Anónimo";
		$pagina="usuario/index_usuario.php";
	}
	header('Location: '.$pagina);
?>
