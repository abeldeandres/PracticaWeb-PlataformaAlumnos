<?php 
	function imprimirMenu(){
		echo '       <ul>
                        <li class="nivel1">Grupos de trabajo
                        	<ul>
								<li><a href="listar_grupos.php">Listar grupos</a></li>
                            	<li><a href="reuniones_grupo.php">Ver reuniones de un grupo</a></li>
                            </ul>
                        </li>
                        <li class="nivel1">Consultar
                        	<ul>
								<li><a href="consultar_contenidos_publico.php">Ver contenido publico</a></li>
                            </ul>
                        </li>
                    </ul>';
	}
	
?>