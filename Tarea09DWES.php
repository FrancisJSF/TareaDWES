<!DOCTYPE html>
<html>
    <head>
		<title>Consulta de Libros</title>
		<meta charset="utf-8">
		<style>
			
			
			h1 {		
				text-align: center;
				text-decoration: underline;
				font-family: Bradley Hand ITC;
				font-size: 100px;
			}
			table, th, tr {
				
				border:solid;
			}
			
			input:focus {
				background-color: #F781D8;
				width: 250px;
				color: black;
				
					}
			
			label {
				width: 300px;
				float: left;
				font-weight: bold;
				}

			fieldset {
					border: #F781D8 solid;
					margin: 10px;
				}

			fieldset legend{
					color: #0A2A0A;
					text-align: center;
			}
			
			#bot {
				margin: 5px;
			}
			
		</style>
		

</script>
    </head>
    
    <body style="background-color:#D4EFDF">



<div class="cabecera">
		
		<h1>Consulta de Libros </h1>
</div>	

		<fieldset>
				<legend> Cosultar Libros </legend>
					
				<form method="GET">
				
					<label for="titulo">Cosultar datos de autores y sus libros</label><input id ="id" type = "text" placeholder = "Escribe el nombre del autor" name = "id" autofocus/>
					<input type="submit" name ="consultar" value="consultar" id="consultar"/>
					<br>
					<p>* Si alguna de las letras las cotiene algun nombre de autor, te mostrara los datos de dicho autor y sus libros</p>
					<br>
					<!-- En el span con id="sugerencias" mostraremos las coincidencias -->
					<p><strong>Resultado:</strong> <span id="sugerencias" style="color: #0080FF;"></span></p>
					<?php

					// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
					if (isset($_GET["consultar"]) && isset($_GET["id"]) == "get_datos_autor") 
					{
						
						
						//Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
						$app_info = file_get_contents('http://localhost/api2.php?action=get_datos_autor&id=' . $_GET["id"]);
						// Se decodifica el fichero JSON y se convierte a array
						$app_info = json_decode($app_info, true);
					?>
						 <?php foreach($app_info as $autor): ?>
						<p>
							<td>Nombre: </td><td> <?php echo $autor["nombre"] ?></td>
						</p>
						<p>
							<td>Apellidos: </td><td> <?php echo $autor["apellidos"] ?></td>
						</p>
						<p>
							<td>Fecha de nacimiento: </td><td> <?php echo $autor["nacionalidad"] ?></td>
						</p>
						<?php 
						
						$autorID = $autor["id"];
						endforeach; ?>
						<ul>
						<?php
						
						//Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
						$app_info = file_get_contents('http://localhost/api2.php?action=get_lista_libros&id=' . $autorID);
						// Se decodifica el fichero JSON y se convierte a array
						$app_info = json_decode($app_info, true);
						?>
						
						<?php foreach($app_info as $libro): ?>
							<li>
								<?php 
								
								echo $libro["titulo"];?>
							</li>
						<?php endforeach; ?>
						</ul>	
					<?php
						}
						else {
								
						};				
						?>
						</form>
								</fieldset>
			
    </body>
</html>
