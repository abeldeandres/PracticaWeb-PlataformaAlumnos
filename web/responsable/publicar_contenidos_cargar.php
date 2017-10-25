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
                <?php 
					
					$idReuniones = $_SESSION['idReuniones'];
					echo "<b>Id Reunion: ".$idReuniones."</b>";
					
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
                <form method="post" action="cargar.php" enctype="multipart/form-data"> 
                	<input type="hidden" name="idReuniones" value="<?php echo $idReuniones;?>" /> 
                    <input type="text" name="nombre" value="" /> nombre <br>
                    descripcion<br>
                    <textarea name='descripcion'></textarea>  
                    <select name ="visibilidad" size="1">
                        <option value="Publico">Publico</option>
                        <option value="Privado">Privado</option>
                    </select>
                    Visibilidad <br>
                    
                    <p class="form_envio" >
                    <input type="file" name="nombreArchivo">   
                    </p>
                    <p class="form_envio" >
                    <input  id="form_modificar" type="submit" name="boton" value="Enviar"> 
                    </p>
                </form>

                
            </div>
        </div>
	</body>
</html>