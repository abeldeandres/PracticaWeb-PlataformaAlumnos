<?php include("../misFuncionesMySQL.php");?>
<?php         
	session_start();
	@$rutaOrigen  = $_FILES['nombreArchivo']['tmp_name'];
	@$rutaDestino = $_FILES['nombreArchivo']['name'];
	
	if(isset($rutaOrigen) && isset($rutaDestino) && $rutaDestino!=""){
		@$ruta   = "../archivos/".$rutaDestino;
		@$nombre = $_POST['nombre'];
		@$descripcion = $_POST['descripcion'];
		@$idReuniones  = $_POST['idReuniones'];
		@$visibilidad = 0 ;
		
		if($_POST['visibilidad']=="Publico") $visibilidad=1;

		crearContenido($ruta,$nombre,$descripcion,$visibilidad,$idReuniones);
		//Cargamos..
		if ((isset($_FILES['nombreArchivo']['tmp_name']) && ($_FILES['nombreArchivo']['error'] == UPLOAD_ERR_OK))) { 
			$ruta = '../archivos/';     
			move_uploaded_file($_FILES['nombreArchivo']['tmp_name'], $ruta.$_FILES['nombreArchivo']['name']);
		}
		$_SESSION['mensaje']="Archivo cargado correctamente";
		$_SESSION['correcto']=TRUE;
		header('Location: publicar_contenidos.php');
	}
	else{
		$_SESSION['mensaje']="No ha especificado la ruta";
		$_SESSION['correcto']=FALSE;
		header('Location: publicar_contenidos_cargar.php');
	}
?>