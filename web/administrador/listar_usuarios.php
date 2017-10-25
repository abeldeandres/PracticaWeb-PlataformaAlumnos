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
                <p><b>Lista de usuarios</b></p>
				<?php
					$listaUsuarios = obtenerTodosLosUsuarios();
					while($fila = mysql_fetch_array($listaUsuarios)){
					?>
						<p>
						<b>ID     : <?php echo $fila['idUsuario']; ?> </b><br />
                        Nombre : <?php echo $fila['nombre']; ?> <br />
                        Correo : <?php echo $fila['correo']; ?> <br />
                        <?php 
						if($fila['esAdmin']==1) echo 'Administrador';
						else echo 'Usuario';
						?><br />		
                        </p>
					<?php 
					}
					mysql_free_result($listaUsuarios);
				?>
                
            </div>
        </div>
	</body>
</html>