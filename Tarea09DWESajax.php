<!DOCTYPE html>
<html>
    <head>
		<title>Consulta de Autores</title>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script>
				//Selccionamos con Jquery cuando el ussaurio pulse una letra dentro del label
				$(document).ready(function(){
					$("#id").keyup(function(){
						//con Ajax creamos una conexion asincrona
						$.getJSON('http://localhost/api3.php?action=get_datos_autor&id=' + $("#id").val(), function( data ) {
							  let texto = "<br>";
							  for(let i=0;i<data.length;i++)
							  {
								texto = texto + "<br>" + data[i].titulo; 
							  }
							 //Escribimos lo que hemos traido de la base de datos en el html
							  $("#sugerencias").html(texto);
							});

					});
				});


		</script>
		

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
					<p><strong>Sugerencias:</strong> <span id="sugerencias" style="color: #0080FF;"></span></p>
					<p><strong>Resultado:</strong></p>
					
					
					<?php
					error_reporting(0);
					// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
					if (isset($_GET["consultar"]) && isset($_GET["id"])) 
					{
						
						
						//Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
						$app_info = file_get_contents('http://localhost/api3.php?action=get_datos_autor&id=' . $_GET["id"]);
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
						
						//Se realiza la peticion a la api que nos devuelve el JSON con la lista de los libros
						$app_info = file_get_contents('http://localhost/api3.php?action=get_lista_libros&id=' . $autorID);
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