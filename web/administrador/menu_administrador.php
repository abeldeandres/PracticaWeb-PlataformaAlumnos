<?php 
	function imprimirMenu(){
		echo '       <ul>
                        <li class="nivel1"><a href="configuracion.php">Configuración</a></li>
                        <li class="nivel1">Gestionar Usuarios
                        	<ul>
                            	<li><a href="listar_usuarios.php">Listar usuarios</a></li>
                                <li><a href="crear_usuario.php">Crear usuario</a></li>
                                <li><a href="modificar_usuario.php">Modificar usuario</a></li>
                            </ul>
                        </li>
                        <li class="nivel1">Gestionar Grupos
                        	<ul>
                            	<li><a href="listar_grupos.php">Listar grupos</a></li>
                                <li><a href="crear_grupo.php">Crear grupo</a></li>
                                <li><a href="modificar_grupo_busqueda.php">Modificar grupo</a></li>
                            </ul>
                        </li>
                        <li class="nivel1"> <a href="asignar_responsable.php">Selecionar Responsable</a></li>
                    </ul>';
	}
	
?>