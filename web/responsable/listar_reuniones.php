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
					$listaReuniones = obtenerTodasLasReuniones($idUsuario);
					while($fila = mysql_fetch_array($listaReuniones)){
					?>
						<p>
						<b>ID Reunion : <?php echo $fila['idReuniones']; ?> </b><br />
                        <b>ID Grupo   : <?php echo $fila['idGrupo'];?> </b><br />
                        Fecha      : <?php echo $fila['fecha']; ?> <br />
                        Descripcion: <?php echo $fila['descripcion']; ?> <br />
                        </p>
					<?php 
					}
					mysql_free_result($listaReuniones);
				?>
                
                
            </div>
        </div>
	</body>
</html>