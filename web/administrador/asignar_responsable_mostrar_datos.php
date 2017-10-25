<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$boton   = $_POST['boton'];
	@$idGrupo = $_POST['form_idGrupo'];
	@$selector_idUsuario = $_POST['asignar_responsable'];
	
	if($boton=='Seleccionar Responsable'){
		$_SESSION['responsable']=$selector_idUsuario;
		agregarResponsable($idGrupo,$selector_idUsuario);
	}
	else if($boton=='Eliminar Responsable'){
		$_SESSION['responsable']="";
		agregarResponsable($idGrupo,NULL);
	}
	header('Location: asignar_responsable_mostrar.php');
?>