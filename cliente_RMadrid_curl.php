<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Mostrar resultados Real Madrid</title>
		<style>
			h1 {		
				text-align: center;
				text-decoration: underline;
				font-family: Harlow Solid Italic;
				font-size: 100px;
			}
		</style>

	</head>

	<body style="background-color:#FFF8DC">
		<div class="cabecera">
				
				<h1>Resultados Real Madrid temporada 21/22 </h1>
		</div>		
		<section>
		<?php
        //Llamar api
        $url ="https://fixturedownload.com/feed/json/la-liga-2021/real-madrid";
		$ch = curl_init();                                                                      
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
        curl_setopt($ch, CURLOPT_URL, $url);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                                                                                                                    
		$json = curl_exec($ch);

		//Decodificar json, extraer datos
		$datos = json_decode($json, true);
      
        foreach($datos as $dato)
        {
            echo "<b>Partido:</b> " . $dato["HomeTeam"] . " - " . $dato["AwayTeam"];
            echo "<br>";
            echo "<b>Resultado:</b> " . $dato["HomeTeamScore"] . " - " . $dato["AwayTeamScore"];
            echo "<br>";
            echo "<b>Campo:</b> " . $dato["Location"];
            echo "<br> ";
			echo "<b>Fecha:</b> " . $dato["DateUtc"];
            echo "<br> ";
			echo "<hr>";
            echo "<br> ";
        }

		?>
		</section>		
	</body>
</html>