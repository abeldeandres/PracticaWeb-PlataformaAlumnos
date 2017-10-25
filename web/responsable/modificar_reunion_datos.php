<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$boton      = $_POST['boton'];
	
	
	@$idReuniones = $_POST['form_idReuniones'];
	 if($boton=='Modificar'){
		@$descripcion = $_POST['descripcion'];
		@$fecha      = $_POST['fecha'];
		
		modificarReunion($idReuniones,$descripcion,$fecha);
		$_SESSION['mensaje']="Modificado correctamente";
		header('Location: modificar_reuniones.php');
	}
	else{
		eliminarReunion($idReuniones);
		header('Location: modificar_reunion_busqueda.php');		
	}
	
?>