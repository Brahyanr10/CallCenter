<?php
header("Access-Control-Allow-Origin: *");
header("content-type: text/html; charset=utf-8");
$conn = new mysqli( 'localhost', 'root', '', 'callcenter' );
if ( $conn->connect_error ) {
  die( 'Error al conectarse a la base de datos' );
}
$res = array( 'error' => false );
$action = 'read';
if ( isset( $_GET['action'] ) ) {
  $action = $_GET['action'];
}

if ($action == 'login' ) {
  $identificacion = $_POST['identificacion'];
  $password = $_POST['password'];
  $result= $conn->query("SELECT * FROM usuarios WHERE (identificacion='$identificacion' AND password='$password') ");
  $usuario = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $usuario, $row );
  }
  $res['usuario'] = $usuario;
}

if($action =='listarusuarios2'){
  $result = $conn->query( "SELECT * FROM usuarios " );
  $usuarios = array();
  // echo $noticias;
  while ( $row = $result->fetch_assoc() ) {
    array_push( $usuarios, $row );
    // echo $noticias[0];
  }
  $res['usuarios'] = $usuarios;

}

if($action=='editusuario'){
  $idusuario =$_POST['idusuario'];;
  $result= $conn->query("SELECT * FROM usuarios WHERE (idUsuarios='$idusuario')");
  $usuarios = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $usuarios, $row );
  }
  $res['usuarios'] = $usuarios;

}

if($action =='listarusuarios'){
  $result = $conn->query( "SELECT * FROM usuarios " );
  $usuarios = array();
  // echo $noticias;
  while ( $row = $result->fetch_assoc() ) {
    array_push( $usuarios, $row );
    // echo $noticias[0];
  }
  $res['usuarios'] = $usuarios;

}

if ( $action == 'create' ) {
  $identificacion = $_POST['identificacion'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email= $_POST['email'];
  $telefono=$_POST['telefono'];
  $password=$_POST['password'];
  $tipo_persona = 2;

  $result = $conn->query( "INSERT INTO usuarios (identificacion, nombre, apellido, Correo, telefono, password, id_tipo_usuario)
                           VALUES ('$identificacion','$nombre','$apellido','$email','$telefono','$password','$tipo_persona')" );
  if ( $result ) {
    $res['message'] = 'Estudiante agregado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de agregar estudiante.";
  }
}

if ( $action == 'updateusuario' ) {
  $idusuario = $_POST['idusuario'];
  $identificacion = $_POST['identificacion'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $correo=$_POST['correo'];
  $telefono=$_POST['telefono'];
  $password=$_POST['password'];
  $result = $conn->query( "UPDATE usuarios SET identificacion = '$identificacion',
                          nombre = '$nombre',
                          apellido = '$apellido',
                          Correo = '$correo',
                          telefono = '$telefono',
                          password = '$password' WHERE (idUsuarios = '$idusuario') " );

  if ( $result ) {
    $res['message'] = 'Estudiante actualizado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de actualizar estudiante.";
  }
}

if ( $action == 'delete' ) {
  $id = $_POST['id'];
  $result = $conn->query( "DELETE FROM students WHERE id = $id" );

  if ( $result ) {
    $res['message'] = 'Estudiante eliminado con éxito.';
  } else{
    $res['error'] = true;
    $res['message'] = "Error al tratar de eliminar estudiante.";
  }
}
//////////////////////////comuna/////////////////
if ( $action == 'agregarcomuna' ) {
  $nom_comuna = $_POST['comuna'];
  $result = $conn->query( "INSERT INTO comuna (nom_comuna)
                           VALUES ('$nom_comuna')" );
  if ( $result ) {
    $res['message'] = 'Estudiante agregado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de agregar estudiante.";
  }
}

if($action =='listarcomuna'){
  $result = $conn->query( "SELECT * FROM comuna " );
  $comuna = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $comuna, $row );
  }
  $res['comuna'] = $comuna;
}

if($action=='editcomuna'){
  $idcomuna =$_POST['idcomuna'];;
  $result= $conn->query("SELECT * FROM comuna WHERE (idcomuna='$idcomuna')");
  $comuna = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $comuna, $row );
  }
  $res['comuna'] = $comuna;

}

if ( $action == 'updatecomuna' ) {
  $idcomuna = $_POST['idcomuna'];
  $num_comuna = $_POST['num_comuna'];
  $result = $conn->query( "UPDATE comuna SET nom_comuna = '$num_comuna'
                           WHERE (idcomuna = '$idcomuna') " );
  if ( $result ) {
    $res['message'] = 'Estudiante actualizado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de actualizar estudiante.";
  }
}

///////////////////////////////// barrio ////////////////////////////
if($action =='listarbarrio'){
  $result = $conn->query( "SELECT *  FROM barrio");
                           // -- INNER JOIN comuna
                           // -- on comuna.idcomuna = barrio.idcomuna" );
  $barrio = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $barrio, $row );
  }
  $res['barrio'] = $barrio;
}

if($action=='editbarrio'){
  $idbarrio =$_POST['idbarrio'];;
  $result= $conn->query("SELECT * FROM barrio WHERE (idbarrio='$idbarrio')");
  $barrio = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $barrio, $row );
  }
  $res['barrio'] = $barrio;

}

$conn->close();
header( 'Content-type: application/json' );
echo json_encode($res);
