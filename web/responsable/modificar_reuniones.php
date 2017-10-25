<?php
	session_start();
	@$idUsuario  = $_SESSION['idUsuario'];
	@$nombre     = $_SESSION['nombre'];
	if(!isset($idUsuario)){ //Si no exsiste
		header('Location: ../index.php');	
	}
?>
<?php include("menu_responsable.php");?>
<?php include("../misFuncionesMySQL.php");?>
<html> 
	<head> 
		<meta charset="utf-8">
        <link rel="stylesheet" href="../css/estilos.css">
		<title>Sistema WEB | <?php echo $idUsuario;?></title> 
	</head> 
	<body> 
    	<div class="cabecera">
            <div class="diseño"><h1>Modo Responsable</h1></div>
            <div class="datos">
                Usuario: <?php echo $idUsuario; ?><br />
                NOmbre: <?php echo $nombre; ?><br />
                <a href="../salir.php">Salir</a>
        </div>
        </div>
        <div class="contenido">
            <div class="lateral">
                <div class="menu_cuadro"> <?php imprimirMenu(); ?></div>
            </div>
            <div class="medio">
                
                   <?php 
						@$mensaje  = $_SESSION['mensaje'];
						@$correcto = $_SESSION['correcto'];
						@$idReuniones  = $_SESSION['idReuniones'];
						if(isset($mensaje) && isset($correcto)){ //Si no exsiste
							if(!$correcto) echo '<font color="#F00">';
							else echo '<font color="#00F">';
							echo '<p><b>'.$mensaje.'</b></p>';
							echo '</font>';
							unset($_SESSION['mensaje']);
							unset($_SESSION['correcto']);
						}
						if(isset($idReuniones)){
							$linea = obtenerReunion($idReuniones);
							@$idReuniones_form = $linea['idReuniones'];
							@$fecha_form = $linea['fecha'];
							@$descripcion_form=$linea['descripcion'];
							unset($idReuniones);//variable global o de sesion liberada
						}
					?>
                 	<p><b>Modificar Reuniones</b></p>
                    
                 	<form class="form" action="modificar_reunion_datos.php" method="POST">  
                    	<b><?php echo 'ID Reunion : '.$idReuniones_form.' ';?></b><br/>
                        <p class="form_texto">  
                            <input type="date" name="fecha" value="<?php echo $fecha_form;?>" />  
                            <label for="date">Fecha de Reunion</label>  
                        </p>                    
                        <p class="form_texto">  
                        	<textarea name='descripcion'><?php echo $descripcion_form; ?></textarea>
                            <label for="name">Descripcion</label>    
                        </p> 
                        <p class="form_envio" >
                            <input type="hidden" name="form_idReuniones" value="<?php echo $idReuniones_form; ?>" />
                            <input id="form_modificar" type="submit" name="boton" value="Modificar" /> 
                            <input id="form_eliminar" type="submit" name="boton" value="Eliminar" /> 
                         </p> 
                     </form> 
                
            </div>
        </div>
	</body>
</html>