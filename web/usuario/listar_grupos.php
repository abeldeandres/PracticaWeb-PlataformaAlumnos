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
					$listaGrupos = obtenerTodosLosGrupos();
					while($fila = mysql_fetch_array($listaGrupos)){
					?>
						<p>
						<b>ID Grupo   : <?php echo $fila['idGrupo']; ?> </b><br />
                        <b>ID Responsable: <?php if($fila['idJefe']!=FALSE) echo $fila['idJefe'];?></b><br />
                        Nombre     : <?php echo $fila['nombre']; ?> <br />
                        Descripcion: <?php echo $fila['descripcion']; ?> <br />
                        </p>
					<?php 
					}
					mysql_free_result($listaGrupos);
				?>
                
                
            </div>
        </div>
	</body>
</html>