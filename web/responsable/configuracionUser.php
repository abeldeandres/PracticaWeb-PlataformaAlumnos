<?php
	session_start();
	@$idUsuario  = $_SESSION['idUsuario'];
	@$nombre     = $_SESSION['nombre'];
	if(!isset($idUsuario)){ //Si no exsiste
		header('Location: ../index.php');	
	}
?>
<?php include("menu_responsable.php");?>
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
				<div class="formularios">
					<?php //leemos los datos para precargarlo
						include("../misFuncionesMySQL.php");
						$linea = obtenerUsuario($idUsuario);
						@$mensaje  = $_SESSION['mensaje'];
						@$correcto = $_SESSION['correcto'];
					?>
					<?php 
						if(isset($mensaje) && isset($correcto)){ //Si no exsiste
							if(!$correcto) echo '<font color="#F00">';
							else echo '<font color="#00F">';
							echo '<p><b>'.$mensaje.'</b></p>';
							echo '</font>';
							unset($_SESSION['mensaje']);
							unset($_SESSION['correcto']);
						}
					?>
                 	<p><b><?php echo $idUsuario;?></b></p>
                 	<form class="form" action="configuracionUser_datos.php" method="POST">  
                        <p class="form_texto">  
                            <input type="text" name="nombre" id="name" value="<?php echo $linea['nombre']; ?>" />  
                            <label for="name">Nombre</label>  
                        </p>                    
                        <p class="form_texto">  
                            <input type="text" name="correo" id="email" value="<?php echo $linea['correo']; ?>" />  
                            <label for="email">Correo</label>  
                        </p>  
                        <p class="form_texto">  
                            <input type="password" name="pass" id="web" />  
                            <label for="web">*Contraseña actual</label>  
                        </p>  
						<p class="form_texto">  
                            <input type="password" name="pass1" id="web" />  
                            <label for="web">Contraseña nueva</label>  
                        </p> 
						<p class="form_texto">  
                            <input type="password" name="pass2" id="web" />  
                            <label for="web">Repite contraseña</label>  
                        </p> 
                        <p class="form_envio">  
                            <input type="submit" value="Guardar" />  
                        </p>  
                     </form> 
                 </div>
				
            </div>
        </div>
	</body>
</html>