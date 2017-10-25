<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$idReuniones    = $_POST['idReuniones'];	
	/*
	$consulta = "SELECT * FROM `tgrupo` WHERE idGrupo=".$idGrupo;//'".$idGrupo."'"
	$linea = realizaConsultaCompleta($consulta);
	$fila = mysql_fetch_array($linea);
	*/
	$fila= obtenerReunion($idReuniones);
	//echo $fila['idGrupo'];

	if($fila>0){
		$_SESSION['correcto']=TRUE;
		$_SESSION['mensaje']="";
		$_SESSION['idReuniones']=$idReuniones;
		header('Location: modificar_reuniones.php');
	}
	else{
		$_SESSION['correcto']=FALSE;
		$_SESSION['mensaje']="Reunion no encontrada";
		header('Location: modificar_reunion_busqueda.php');
	}
?>