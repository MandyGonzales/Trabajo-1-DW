<?php

try{
      $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
      } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
      
      }

$input = $_POST;

$statement = $dbh->prepare("INSERT INTO tabla2 (Departamento,Ciudad,Fecha_Ped,Fecha_Nac,Valor,Cantidad_prod,Email,FK_TABLA1) VALUES (?,?,?,?,?,?,?,?)");

$statement->execute([
      $_POST['departamento'],
      $_POST['ciudad'],
      $_POST['fecha_ped'],
      $_POST['fecha_nac'],
      $_POST['valor'],
      $_POST['cantidad_prod'],
      $_POST['email'],
      $_POST['fk_tabla1']
]);

$postId = $dbh->lastInsertId();

//buscamos los campos del registro insertado
$sql = $dbh->prepare("SELECT * FROM tabla2 where id= ?");
$sql->execute(
      [
            $postId
      ]);

$dato = $sql->fetch(PDO::FETCH_OBJ);

 //busca el los datos del fk 
 $sql1 = $dbh->prepare("SELECT * FROM tabla1 where id= ?");
 $sql1->execute([$dato->FK_TABLA1]);

 $fk =$sql1->fetch(PDO::FETCH_OBJ);

 $res =  array(
      'id' =>  $dato->ID ,
      'departamento' =>  $dato->Departamento,
      'ciudad' =>  $dato->Ciudad,
      'fecha_ped' =>  $dato->Fecha_ped, 
      'fecha_nac' =>  $dato->Fecha_Nac,
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

header("HTTP/1.1 200 OK");
echo json_encode($res);


