<?php
	session_start();
	@$idUsuario  = $_SESSION['idUsuario'];
	@$nombre     = $_SESSION['nombre'];
	if(!isset($idUsuario)){ //Si no exsiste
		header('Location: ../index.php');	
	}
?>
<?php include("menu_usuario.php");?>
<?php include("../misFuncionesMySQL.php");?>
<html> 
	<head> 
		<meta charset="utf-8">
        <link rel="stylesheet" href="../css/estilos.css">
		<title>Sistema WEB | <?php echo $idUsuario;?></title> 
	</head> 
	<body> 
    	<div class="cabecera">
            <div class="diseño"><h1>Modo Usuario</h1></div>
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
                <form class="form" action="reuniones_grupo_datos.php" method="POST">
                    <label for="name">ID Reunion</label> <br/>
                    <input type="text" name="idGrupo" value="" />  
                    
                    <p class="form_envio" >
                    <input id="form_modificar" type="submit" name="boton" value="Buscar" /> 
                    </p>
                </form>	
                
                
            </div>
        </div>
	</body>
</html>