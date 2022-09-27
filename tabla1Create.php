<?php

try{
  $dbh = new PDO('mysql:host=localhost;dbname=trabajo1dw', 'dark', 'local12345$');
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  
  }

$sql =$dbh->prepare("INSERT INTO tabla1 (Nombre,Apellido,Sexo) VALUES (?,?,?)");

$sql->execute([
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['sexo']
]);

$id = $dbh->lastInsertId();

if($id)
{
  $input = array(
      'id' => $id,
      'nombre'=> $_POST['nombre'],
      'apellido' => $_POST['apellido'],
      'sexo' => $_POST['sexo']
  );

  header("HTTP/1.1 200 OK");
  echo json_encode($input);
  exit();
 }

