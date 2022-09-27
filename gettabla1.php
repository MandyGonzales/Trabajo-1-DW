<?php


//OBTENER TODOS LOS REGISTROS DE LA TABLA 1



//Conexion Con el servidor
try {
    $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


// Ejecución de la consulta
try {    
    $sql = "SELECT * from tabla1 LIMIT 10";

    // Creo una sentencia preparada
    $statement=$dbh->prepare("SELECT * from tabla1 LIMIT 10");

    // Ejecuto la sentencia preparada
    $statement->execute();

    // Obtengo todos los datos en un array
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Desconexión de la base de datos
    $dbh = null;
    
    // Retorno resultados
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($results);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>