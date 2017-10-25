<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$idReuniones    = $_POST['idReuniones'];	

	$fila= obtenerReunion($idReuniones);

	if($fila!=FALSE){
		$_SESSION['correcto']=TRUE;
		$_SESSION['mensaje']="";
		$_SESSION['idReuniones']=$idReuniones;
		header('Location: publicar_contenidos_cargar.php');
	}
	else{
		$_SESSION['correcto']=FALSE;
		$_SESSION['mensaje']="Reunion no encontrada";
		header('Location: publicar_contenidos.php');
	}
?>