<?php
	session_start();
	@$idUsuario  = $_SESSION['idUsuario'];
	@$nombre     = $_SESSION['nombre'];
	if(!isset($idUsuario)){ //Si no exsiste
		header('Location: ../index.php');	
	}
?>
<?php include("menu_responsable.php"); ?>
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
                
                <div class="formularios">
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
                 	<p><b>Convocar reunion</b></p>
                 	<form class="form" action="crear_reunion_datos.php" method="POST">
                        <p class="form_texto">  
                            <input type="date" name="fecha" value="" />  
                            <label for="name">Fecha (dd/mm/aaa)</label>  
                        </p>
                        
                        <p> Grupos Responsables </p>
						<select name="idGrupo" size="1">
                        	<!-- <OPTION VALUE="link pagina 1">opcion1</OPTION>-->
							<?php
								$listaGrupos = obtenerTodosLosGruposJefe($idUsuario);
								while($fila = mysql_fetch_array($listaGrupos)){
								?>
									<option value="<?php echo $fila['idGrupo'];?>" ><?php echo $fila['nombre'];?> </option>
                                <?php 
								}
								//mysql_free_result($listaGrupos);
							?>
                        </select>
						
                        
                        <p> Descripcion de reunion </p>            
                        <p class="form_texto">  
                            <textarea name='descripcion'></textarea> 
                        </p>  
                        <p class="form_envio">  
                            <input type="submit" value="Crear" />  
                        </p>  
                     </form> 
                 </div>
                
                
            </div>
        </div>
	</body>
</html>