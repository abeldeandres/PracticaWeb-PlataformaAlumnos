<?php
	session_start();
	@$idUsuario  = $_SESSION['idUsuario'];
	@$nombre     = $_SESSION['nombre'];
	if(!isset($idUsuario)){ //Si no exsiste
		header('Location: ../index.php');	
	}
?>
<?php include("menu_administrador.php");?>
<?php include("../misFuncionesMySQL.php");?>
<html> 
	<head> 
		<meta charset="utf-8">
        <link rel="stylesheet" href="../css/estilos.css">
		<title>Sistema WEB | <?php echo $idUsuario;?></title> 
	</head> 
	<body> 
    	<div class="cabecera">
            <div class="diseño"><h1>Modo administrador</h1></div>
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
					
					if(isset($mensaje) && isset($correcto)){ //Si no exsiste
						if(!$correcto) echo '<font color="#F00">';
						else echo '<font color="#00F">';
						echo '<p><b>'.$mensaje.'</b></p>';
						echo '</font>';
						unset($_SESSION['mensaje']);
						unset($_SESSION['correcto']);
					}
				?>
                <p><b>Lista de usuarios</b></p>
				<?php
					$listaUsuarios = obtenerTodosLosUsuarios();
					$i=0;
					$form = "form";
					while($fila = mysql_fetch_array($listaUsuarios)){
						$form .= $i;
						$i++;
						$idUsuario_form = $fila['idUsuario'];
						$nombre_form    = $fila['nombre'];
						$correo_form    = $fila['correo'];
						$pass_form      = $fila['pass'];
						//guardamos si es o no administrador
						?>

						<p><b>
                        <?php 
							echo 'ID : '.$idUsuario_form.' ';
							if($fila['esAdmin']==1) echo '(Administrador)';
							else echo '(Usuario)';
						?></b><br />
                        <form class="<?php $form ?>" action="modificar_usuario_datos.php" method="POST">
                        	<!-- Esto tiene un input invisible-->
                            <input  type="hidden" name="idUsuario_form" value="<?php echo $idUsuario_form; ?>" />
                        	<input type="text" name="nombre_form" value="<?php echo $nombre_form; ?>" />  
                            <label for="name">Nombre</label><br />
                            <input type="text" name="correo_form" value="<?php echo $correo_form; ?>" />  
                            <label for="name">Correo</label><br />
                            <input type="password" name="pass_form" value="<?php echo $pass_form; ?>" />  
                            <label for="name">Contraseña</label>
                            <p class="form_envio" >
                            <input id="form_modificar" type="submit" name="boton" value="Modificar" /> 
                            <input id="form_eliminar" type="submit" name="boton" value="Eliminar" /> 
                            </p>
                        </form>	
                        </p>
						<?php 
					}
					mysql_free_result($listaUsuarios);
					unset($_SESSION['esAdmin_form']);
					unset($_SESSION['idUsuario_form']);
				?>
            </div>
        </div>
	</body>
</html>