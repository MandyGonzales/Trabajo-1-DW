<?php


try{
  $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  
  }

 //verificar si existe el usuario
 $sql = $dbh->prepare("SELECT * FROM tabla2 where ID= ?");
 $sql->execute([$_POST['id']]);
 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_POST['id'] => "no exite registro");

   echo json_encode($res);

 } else {
   
    $dato =$sql->fetch(PDO::FETCH_OBJ);

    //busca el los datos del fk 
    $sql1 = $dbh->prepare("SELECT * FROM tabla1 where id= ?");
    $sql1->execute(
      [
        $dato->FK_TABLA1
      ]
    );

    $fk =$sql1->fetch(PDO::FETCH_OBJ);

    
$id = $_POST['id'];
$statement = $dbh->prepare("DELETE FROM tabla2 where id= ? ");

$statement->execute([
  $_POST['id']
]);
header("HTTP/1.1 200 OK");

$res = array(
  'mensaje'=> 'Registro eliminado satisfactoriamente',
    'id' =>  $dato->ID ,
    'departamento' =>  $dato->Departamento,
    'ciudad' =>  $dato->Ciudad,
    'fecha_ped' =>  $dato->Fecha_ped, 
    'fecha_nac' =>  $dato->Fecha_nac,
    'Valor' =>  $dato->Valor,
    'Cantidad_prod' =>  $dato->Cantidad_prod,
    'email' =>  $dato->Email, 
    "data_fk"=> array(
      'id' =>  $fk->ID ,
      'nombre' =>  $fk->Nombre,
      'apellido' =>  $fk->Apellido ,
      'sexo' =>  $fk->Sexo
    )
);
   echo json_encode($res);
   exit();
 }