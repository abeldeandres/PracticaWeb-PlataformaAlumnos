<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$idGrupo    = $_POST['idGrupo'];	

	$fila= obtenerGrupo($idGrupo);

	if($fila!=FALSE){
		$_SESSION['correcto']=TRUE;
		$_SESSION['mensaje']="";
		$_SESSION['idGrupo']=$idGrupo;
		header('Location: listar_reuniones.php');
	}
	else{
		$_SESSION['correcto']=FALSE;
		$_SESSION['mensaje']="Grupo no encontrado";
		header('Location: reuniones_grupo.php');
	}
?>