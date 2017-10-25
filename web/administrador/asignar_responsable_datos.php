<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$idGrupo = $_POST['form_idGrupo'];
	@$pagina="";
	$linea = obtenerGrupo($idGrupo);
	if($linea!=FALSE){
		$_SESSION['idGrupo']=$linea['idGrupo'];
		if(isset($linea['idJefe'])) $_SESSION['responsable']=$linea['idJefe'];
		else $_SESSION['responsable']="";
		$pagina = "asignar_responsable_mostrar.php";
	}
	else{
		$_SESSION['mensaje']="Grupo ".$idGrupo." no existe";
		$pagina = "asignar_responsable.php";
	}
	header('Location: '.$pagina);
?>