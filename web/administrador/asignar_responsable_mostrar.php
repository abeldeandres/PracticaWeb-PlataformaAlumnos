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
                
                   
                 	<p><b>Modificar grupo</b></p>
                    <?php 
						$idGrupo_form = $_SESSION['idGrupo'];
						$responsable_form = $_SESSION['responsable'];
					?>
                 	<form class="form" action="asignar_responsable_mostrar_datos.php" method="POST">  
                    	<b><?php echo 'ID Grupo : '.$idGrupo_form.' ';?></b><br/>
                        <b><?php echo 'ID Responsable: '.$responsable_form.' ';?></b>
                        
                        <p class="form_envio">
                        <input  type="hidden" name ="form_idGrupo" value="<?php echo $idGrupo_form; ?>" /> <!--  -->
                        <input  id   ="form_modificar" type="submit" name="boton" value="Seleccionar Responsable" />
                        <select name ="asignar_responsable" size="1">
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
                        <p class="form_envio">
                        	<input id="form_eliminar" type="submit" name="boton" value="Eliminar Responsable" />
                        </p>
                        
                     </form> 
                
            </div>
        </div>
	</body>
</html>