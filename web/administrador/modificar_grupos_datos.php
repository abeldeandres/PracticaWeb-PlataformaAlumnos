<?php include("../misFuncionesMySQL.php");?>
<?php
	session_start();
	@$boton      = $_POST['boton'];
	
	
	@$idGrupo = $_POST['form_idGrupo'];
	
	if($boton=='Agregar Usuario'){
		@$selector_idUsuario = $_POST['agregar_usuario'];
		
		agregarMiembroAGrupo($selector_idUsuario,$idGrupo);
		header('Location: modificar_grupo.php');
	}
	else if($boton=='Eliminar Usuario'){
		@$selector_idUsuario = $_POST['eliminar_usuario'];

		eliminarMiembroDeGrupo($selector_idUsuario,$idGrupo);
		header('Location: modificar_grupo.php');
	}
	else if($boton=='Modificar'){
		@$descripcion = $_POST['descripcion'];
		@$nombre      = $_POST['nombre'];
		
		modificarGrupo($idGrupo,$descripcion,$nombre);
		header('Location: modificar_grupo.php');
	}
	else if($boton=='Eliminar'){
		eliminarGrupo($idGrupo);
		header('Location: modificar_grupo_busqueda.php');		
	}
	
?>