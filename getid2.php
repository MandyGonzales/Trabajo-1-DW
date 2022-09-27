<?php


//OBTENER UN REGISTRO DE LA TABLA 2 POR EL ID2



//Conexion Con el servidor
try {
    $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


$ID2 = $_GET['id'];

// Ejecución de la consulta
try {    
    // Creamos una sentencia preparada
    $statement=$dbh->prepare("SELECT * from tabla2 WHERE ID = ?");

    // Asociamos los parametros
    $statement->bindParam(1, $_GET['id']);

    // Ejecuto la sentencia preparada
    $statement->execute();

    // Obtengo todos los datos en un array
    $results = $statement->fetch(PDO::FETCH_ASSOC);

    // Desconexión de la base de datos
    $dbh = null;
    
    // Retorno resultados
    header('Content-type:application/json;charset=utf-8');
    echo json_encode([
        'Registro' => $results
    ]);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>