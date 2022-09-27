<?php


try{
$dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();

}


 //verificar si existe el usuario
 $sql = $dbh->prepare("SELECT * FROM tabla1 where id= ?");
 $sql->execute(
    [
        $_POST['id']
]);

 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_POST['id'] => "no exite registro");

   echo json_encode($res);

 } else {
   
    $dato =$sql->fetch(PDO::FETCH_OBJ);

    
$statement = $dbh->prepare("DELETE FROM tabla1 where id= ? ");

$statement->execute([
    $_POST['id']
]);

header("HTTP/1.1 200 OK");

$res = array(
    'mensaje'=> 'Registro eliminado satisfactoriamente',
    'data' => array(
        'id' =>  $dato->ID ,
        'nombre' =>  $dato->Nombre,
        'apellido' =>  $dato->Apellido ,
        'sexo' =>  $dato->Sexo
    )
);
   echo json_encode($res);
   exit();
 }


?>