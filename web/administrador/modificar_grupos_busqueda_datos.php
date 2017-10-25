<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$idGrupo    = $_POST['idGrupo'];	
	/*
	$consulta = "SELECT * FROM `tgrupo` WHERE idGrupo=".$idGrupo;//'".$idGrupo."'"
	$linea = realizaConsultaCompleta($consulta);
	$fila = mysql_fetch_array($linea);
	*/
	$fila= obtenerGrupo($idGrupo);
	//echo $fila['idGrupo'];

	if($fila>0){
		$_SESSION['correcto']=TRUE;
		$_SESSION['mensaje']="";
		$_SESSION['idGrupo']=$idGrupo;
		header('Location: modificar_grupo.php');
	}
	else{
		$_SESSION['correcto']=FALSE;
		$_SESSION['mensaje']="Grupo no encontrado";
		header('Location: modificar_grupo_busqueda.php');
	}
?>