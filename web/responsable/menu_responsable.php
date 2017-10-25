<?php 
	function imprimirMenu(){
		echo '       <ul>
                        <li class="nivel1"><a href="configuracionUser.php">Configuración</a></li>
                        <li class="nivel1">Gestionar reuniones Grupo Trabajo
                        	<ul>
                            	<li><a href="listar_reuniones.php">Listar reuniones</a></li>
                                <li><a href="convocar_reuniones.php">Convocar reuniones</a></li>
                                <li><a href="modificar_reunion_busqueda.php">Modificar reuniones</a></li>
                            </ul>
                        </li>
                        <li class="nivel1">Consultar
                        	<ul>
                            	<li><a href="publicar_contenidos.php">Publicar contenido</a></li>
								<li><a href="consultar_contenidos_privado.php">Ver contenido privado</a></li>
								<li><a href="consultar_contenidos_publico.php">Ver contenido publico</a></li>
                            </ul>
                        </li>
                    </ul>';
	}
	
?>