<?php

try{
    $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    
    }

//verificar si existe el usuario
$sql = $dbh->prepare("SELECT * FROM tabla1 where ID= ?");
$sql->execute([
    $_POST['id']
]);

$result = $sql->rowCount();

if ($result<=0) {
   $res = array("ID ". $_POST['id'] => "no exite registro");

  echo json_encode($res);

} else {
  
   $dato =$sql->fetch(PDO::FETCH_OBJ);

    $sql = "UPDATE tabla1 SET Nombre= ? , Apellido = ? , Sexo = ?  WHERE id= ? ";

    $statement = $dbh->prepare($sql);
    $statement->execute([
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['sexo'],
    $_POST['id'],
    ]);

    header("HTTP/1.1 200 OK");

    $res = array(
        'mensaje'=> 'Registro actualizado satisfactoriamente',
        'data' => array(
            'id' =>  $_POST['id'] ,
            'nombre' =>  $_POST['nombre'],
            'apellido' =>  $_POST['apellido'],
            'sexo' =>  $_POST['sexo'] 
        )
    );

echo json_encode($res);
exit();
}
