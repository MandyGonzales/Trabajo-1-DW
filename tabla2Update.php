<?php

try{
    $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    
    }

//verificar si existe el usuario
$sql = $dbh->prepare("SELECT * FROM tabla2 where ID = ?");
$sql->execute([
    $_POST['id']
]);
$result = $sql->rowCount();

if ($result<=0) {
   $res = array("ID ". $_POST['id'] => "no exite registro");

  echo json_encode($res);

} else {
  
   $dato =$sql->fetch(PDO::FETCH_OBJ);

    $sql = "UPDATE tabla2 SET Departamento = ?,Ciudad = ?,Fecha_Ped= ?,Fecha_nac = ?,Valor = ?,Cantidad_prod = ?,Email = ?,FK_TABLA1 = ?  WHERE id= ? ";

    $statement = $dbh->prepare($sql);
    $statement->execute([
        $_POST['departamento'],
      $_POST['ciudad'],
      $_POST['fecha_ped'],
      $_POST['fecha_nac'],
      $_POST['valor'],
      $_POST['cantidad_prod'],
      $_POST['email'],
      $_POST['fk_tabla1'],
        $_POST['id'],
    ]);

    header("HTTP/1.1 200 OK");
    
    //busca el los datos del fk 
    $sql1 = $dbh->prepare("SELECT * FROM tabla1 where id= ?");
    $sql1->execute([$_POST['fk_tabla1']]);

    $fk =$sql1->fetch(PDO::FETCH_OBJ);

    $res = array(
        'mensaje'=> 'Registro Actualizado satisfactoriamente',
        'data' => array(
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
      ))
    );

echo json_encode($res);
exit();
}
