<?php
	session_start();  //abrimos posible sesion
	@$mensaje = $_SESSION['mensaje'];
?>
<!DOCTYPE HTML>
<html> 
	<head> 
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/login.css">
		<title>Sistema WEB | Login</title> 
	</head> 
	<body>
    	<div style="height:30px;"></div>
    	<div class="marco">
            <div class="center" >
                <h1> Bienvenidos a nuestra pagina web</h1>
                <div style="height:30px;"></div>
                <?php 
					if(isset($mensaje)){
						echo '<font color="#F00"><p>'.$mensaje.'</p></font>';
						unset($_SESSION['mensaje']);
					}
				?>
                <div class="marcoInterior"><!-- class="login"-->
                	
                	<div class="rectangulo">
                    	<br />
                        <form name="prom" action="login.php" method="POST" align="center"/> 
                        <div class="campos"><!-- class="ladoIzq"-->
                           <p class="form_texto"> 
                            <label for="email">ID Usuario</label>  
                            <input type="text" name="idUsuario" valie"" />  
                           </p>
                           <p class="form_texto"> 
                            <label for="email">Contraseña</label>  
                            <input type="password" name="pass" valie"" />  
                           </p> 
                           <p class="form_login" align="center">  
                                <input type="submit" name="boton" value="Ingresar" />  
                                <input type="submit" name="boton" value="Invitado" />  
                           </p>  
                           
                        </div><br />
                        
                    </div>
                </div>
            </div>
        </div>
		<div style="height:30px;"></div>
        <h4 align="center"><small>(C) Abel....</small></h4>
    </body>
</html>

