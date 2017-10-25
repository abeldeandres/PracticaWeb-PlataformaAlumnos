<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	//@$idUsuarioAdmin  = $_SESSION['idUsuario'];
	//Recuperamos de post
	@$fecha      = $_POST['fecha'];
	@$idGrupo      = $_POST['idGrupo'];
	@$descripcion = $_POST['descripcion'];
	

	if(convocarReunion($idGrupo,$fecha,$descripcion)!=FALSE){
		$_SESSION['mensaje']='Reunion creada con exito';
		$_SESSION['correcto']=TRUE;
	}
	else{
		$_SESSION['mensaje']='Hay monos en el sistema no se pudo crear la reunion';
		$_SESSION['correcto']=FALSE;
	}
	header('Location: convocar_reuniones.php');
	
?>