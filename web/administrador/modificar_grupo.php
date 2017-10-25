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
						@$idGrupo  = $_SESSION['idGrupo'];
						if(isset($mensaje) && isset($correcto)){ //Si no exsiste
							if(!$correcto) echo '<font color="#F00">';
							else echo '<font color="#00F">';
							echo '<p><b>'.$mensaje.'</b></p>';
							echo '</font>';
							unset($_SESSION['mensaje']);
							unset($_SESSION['correcto']);
						}
						if(isset($idGrupo)){
							$linea = obtenerGrupo($idGrupo);
							@$idGrupo_form = $linea['idGrupo'];
							@$nombre_form = $linea['nombre'];
							@$descripcion_form=$linea['descripcion'];
							@$responsable_form=$linea['idJefe'];
							unset($idGrupo);//variable global o de sesion liberada
						}
					?>
                 	<p><b>Modificar grupo</b></p>
                    
                 	<form class="form" action="modificar_grupos_datos.php" method="POST">  
                    	<b><?php echo 'ID Grupo : '.$idGrupo_form.' ';?></b><br/>
                        <b><?php echo 'ID Responsable: '.$responsable_form.' ';?></b>
                        <p class="form_texto">  
                            <input type="text" name="nombre" value="<?php echo $nombre_form;?>" />  
                            <label for="name">Nombre de grupo</label>  
                        </p>                    
                        <p class="form_texto">  
                            <input type="text-area" name="descripcion" value="<?php echo $descripcion_form; ?>" />
                            <label for="name">Descripcion</label>    
                        </p> 
						<!-- lista de  usuarios del grupo -->
                        <?php
							$listaUsuarios = obtenerTodosLosUsuariosDeUnGrupo($idGrupo_form);
							while($fila = mysql_fetch_array($listaUsuarios)){
								$idUsuario_form_tabla = $fila['idUsuario'];
								$datos_user= obtenerUsuario($idUsuario_form_tabla);
								echo "<b>".$idUsuario_form_tabla."</b><br />";
								echo "<b>".$datos_user['nombre']."</b><br /><br/>";
							}
							mysql_free_result($listaUsuarios);
							
						?>
                        <p class="form_envio">
                        <input type="hidden" name="form_idGrupo" value="<?php echo $idGrupo_form; ?>" />
                        <input id="form_modificar" type="submit" name="boton" value="Agregar Usuario" />
                        <select name="agregar_usuario" size="1">
                        	<!-- <OPTION VALUE="link pagina 1">opcion1</OPTION>-->
							<?php
                            	//$listaUsuarios = obtenerTodosLosUsuariosQueNoEstanGrupo($idGrupo_form);
								$listaUsuarios = obtenerTodosLosUsuariosQueNoEstanGrupo($idGrupo_form);
								while($fila = mysql_fetch_array($listaUsuarios)){
									$idUsuario_form_tabla = $fila['idUsuario'];
									$datos_user= obtenerUsuario($idUsuario_form_tabla);
									$nombre_form_tabla = $datos_user['nombre'];
									$idUsuario_form_tabla = $datos_user['idUsuario'];
									echo "<option value='".$idUsuario_form_tabla."'>".$nombre_form_tabla."</option>";
								}
							?>
                        </select>
                        
                        </p>
                        <p class="form_envio">
                        <input id="form_eliminar" type="submit" name="boton" value="Eliminar Usuario" /> 
                        <select name="eliminar_usuario" size="1">
                        	<!-- <OPTION VALUE="link pagina 1">opcion1</OPTION>-->
							<?php
                            	//$listaUsuarios = obtenerTodosLosUsuariosQueNoEstanGrupo($idGrupo_form);
								$listaUsuarios = obtenerTodosLosUsuariosDeUnGrupo($idGrupo_form);
								while($fila = mysql_fetch_array($listaUsuarios)){
									$idUsuario_form_tabla = $fila['idUsuario'];
									$datos_user= obtenerUsuario($idUsuario_form_tabla);
									$nombre_form_tabla = $datos_user['nombre'];
									$idUsuario_form_tabla = $datos_user['idUsuario'];
									echo "<option value='".$idUsuario_form_tabla."'>".$nombre_form_tabla."</option>";
								}
							?>
                        </select>
                        
                        </p>
                        <p class="form_envio" >
                            <input id="form_modificar" type="submit" name="boton" value="Modificar" /> 
                            <input id="form_eliminar" type="submit" name="boton" value="Eliminar" /> 
                         </p> 
                     </form> 
                
            </div>
        </div>
	</body>
</html>