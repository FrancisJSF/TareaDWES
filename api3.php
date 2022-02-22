<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.
	/**
	* Metodo que recupera la lista de autores
	* No tiene parametros de entrada
	*
	* @return null si hay un error
	* @return $lista_autores
	*/
function get_lista_autores(){
    
	$mysqli = new mysqli("localhost", "root", "FOC", "Libreria");
	
	$sql = "SELECT * FROM autor";
	
	$resultset = $mysqli->query($sql);
	
	if ($resultset->num_rows > 0 && !$mysqli->error)
			{
				
				$lista_autores = $resultset->fetch_all(MYSQLI_ASSOC);
				return $lista_autores;
			}
		else
			{
				return null;
			}

	$mysqli->close();

}
	/**
	* Metodo que recupera datos de autores
	* @param id
	*
	* @return $info_autor
	*/
function get_datos_autor($id){
	
	$mysqli = new mysqli("localhost", "root", "FOC", "Libreria");
	
	$sql = "SELECT * FROM autor WHERE nombre LIKE '%$id%' ORDER BY nombre";
	
	
	$resultset = $mysqli->query($sql);
	    
		if ($resultset->num_rows > 0 && !$mysqli->error)
			{
				
				$info_autor = $resultset->fetch_all(MYSQLI_ASSOC);
				
				return $info_autor;
			}
		else
			{
				return null;
			}

	$mysqli->close();
		
    
    
}
/**
	* Metodo que recupera la lista de libros
	* No tiene parametros de entrada
	*
	* @return null si hay un error
	* @return $lista_libros
	*/
	function get_lista_libros(){
		$mysqli = new mysqli("localhost", "root", "FOC", "Libreria");
	
	$sql = "SELECT * FROM libros WHERE id_autor='$id'";
	
	
	$resultset = $mysqli->query($sql);
	    
		if ($resultset->num_rows > 0 && !$mysqli->error)
			{
				
				$info_autor = $resultset->fetch_all(MYSQLI_ASSOC);
				
				return $info_autor;
			}
		else
			{
				return null;
			}

	$mysqli->close();
	}
	
	/**
	* Metodo que recupera datos de autores
	* @param id
	*
	* @return $info_libro
	*/
	
	function get_datos_libros($id){
		//Recuperar el id y el titulo de los libros
		$mysqli = new mysqli("localhost", "root", "FOC", "Libreria");
	
	
		$sql = "SELECT titulo,f_publicacion,nombre,apellidos FROM libros l JOIN autor as a ON l.id_autor = a.id where l.id = '$id'";
	
	
	    $resultlibro = $mysqli->query($sql);
		
		$librosArray = $resultlibro->fetch_all(MYSQLI_ASSOC);
	
    $info_libro = array();
    //Esta información se cargará de la base de datos
    switch ($id){
		//IMPORTANTE: Este bloque switch simula dos consultas de la base de datos, 
		// la de libros será un join de las dos tablas
        case 0:
           $info_libro["libros"] = $librosArray;
		  break;
        case 1:
          $info_libro["libros"] = $librosArray;
		  break;
		  case 2:
           $info_libro["libros"] = $librosArray;
		  break;
        case 3:
          $info_libro["libros"] = $librosArray;
		  break;
		  case 4:
           $info_libro["libros"] = $librosArray;
		  break;
        case 5:
          $info_libro["libros"] = $librosArray;
		  break;
		  case 6:
          $info_libro["libros"] = $librosArray;
		  break;
    }
    
    return $info_libro;
	}
	
$posibles_URL = array("get_lista_autores", "get_datos_autor", "get_lista_libros", "get_datos_libros");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"])
    {
      case "get_lista_autores":
        $valor = get_lista_autores();
        break;
      case "get_datos_autor":
        if (isset($_GET["id"]))
            $valor = get_datos_autor($_GET["id"]);
        else
            $valor = "Argumento no encontrado";
        break;
	  case "get_lista_libros":
        $valor = get_lista_libros();
        break;
	  case "get_datos_libros":
        if (isset($_GET["id"]))
            $valor = get_datos_libros($_GET["id"]);
        else
            $valor = "Argumento no encontrado";
        break;	
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>
