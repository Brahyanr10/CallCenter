<?php
header("Access-Control-Allow-Origin: *","content-type: text/html; charset=utf-8");
// header("content-type: text/html; charset=utf-8");
// mysqli_query("SET NAMES 'utf8'");
$conn = new mysqli( 'localhost', 'root', '', 'callcenter2' );
$acentos = $conn->query("SET NAMES 'utf8'");
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

if($action =='buscaruser'){
  $id=$_POST['idusuario'];
  $result = $conn->query( "SELECT * FROM usuarios WHERE idUsuarios='$id' " );
  $usuarios = array();
  // echo $noticias;
  while ( $row = $result->fetch_assoc() ) {
    array_push( $usuarios, $row );
    // echo $noticias[0];
  }
  $res['usuario'] = $usuarios;

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

if ( $action == 'eliminarusuario' ) {
  $id = $_POST['idusuario'];
  $result = $conn->query( "DELETE FROM usuarios WHERE idUsuarios = $id" );

  if ( $result ) {
    $res['message'] = 'Estudiante eliminado con éxito.';
  } else{
    $res['error'] = true;
    $res['message'] = "Error al tratar de eliminar estudiante.";
  }
}

if($action=='buscaridenti'){
  $idusuario =$_POST['identificacion'];
  $result= $conn->query("SELECT * FROM usuarios WHERE (identificacion='$idusuario')");
  $usuarios = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $usuarios, $row );
  }
  $res['usuarios'] = $usuarios;

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

if($action=='buscarcomuna'){
  $comuna =$_POST['comuna'];
  $result= $conn->query("SELECT * FROM comuna WHERE (nom_comuna='$comuna')");
  $comuna = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $comuna, $row );
  }
  $res['comuna'] = $comuna;

}

if($action =='listarcomuna'){
  $result = $conn->query( "SELECT * FROM comuna WHERE nom_comuna <> ' ' " );
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

if ( $action == 'eliminarcomuna' ) {
  $id = $_POST['idcomuna'];
  $result = $conn->query( "DELETE FROM comuna WHERE idcomuna = $id" );

  if ( $result ) {
    $res['message'] = 'Estudiante eliminado con éxito.';
  } else{
    $res['error'] = true;
    $res['message'] = "Error al tratar de eliminar estudiante.";
  }
}
///////////////////////////////// barrio ////////////////////////////
if($action =='listarbarrio'){
  $result = $conn->query( "SELECT * FROM barrio
                           LEFT OUTER JOIN comuna ON barrio.idcomuna = comuna.idcomuna
                           WHERE nom_barrio <> ' ' ");
   $barrio = array();
   while ( $row = $result->fetch_assoc() ) {
    array_push( $barrio, $row );
  }
  $res['barrio'] = $barrio;
}

if($action =='busquedabarrio'){
  $dato =$_POST['datos'];;
  $result = $conn->query( "SELECT * FROM barrio
                           LEFT OUTER JOIN comuna ON barrio.idcomuna = comuna.idcomuna
                           WHERE nom_barrio LIKE '%$dato%' ");
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

if($action=='buscarbarrio'){
  $barrio =$_POST['barrio'];
  $result= $conn->query("SELECT * FROM barrio WHERE (nom_barrio='$barrio')");
  $barrio = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $barrio, $row );
  }
  $res['barrio'] = $barrio;

}

if($action =='comunas'){
  $result = $conn->query( "SELECT * FROM comuna " );
  $comuna = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $comuna, $row );
  }
  $res['comuna'] = $comuna;
}

if($action=='agregarbarrio'){
  $comuna=$_POST['comuna'];
  $barrio=$_POST['barrio'];
  echo $comuna;
  // if ($comuna = 'undefined') {
  //   $result= $conn->query("INSERT INTO barrio (nom_barrio)
  //                            VALUES ('$barrio')" );
  // }else{
  //   $result= $conn->query("INSERT INTO barrio (nom_barrio,idcomuna)
  //                            VALUES ('$barrio','$comuna')" );
  // }
  $result= $conn->query("INSERT INTO barrio (nom_barrio,idcomuna)
                           VALUES ('$barrio','$comuna')" );
  if ( $result ) {
    $res['message'] = 'Estudiante agregado con éxito.';
    } else {
      $res['error'] = true;
      $res['message'] = "Error al tratar de agregar estudiante.";
    }
}

if ( $action == 'updatebarrio' ) {
  $idbarrio = $_POST['idbarrio'];
  $nom_barrio = $_POST['nombre'];
  $idcomuna = $_POST['idcomuna'];

  if ($idcomuna == 'null') {
    echo"entro";
    $result = $conn->query( "UPDATE barrio SET nom_barrio = '$nom_barrio'
                             WHERE (idbarrio = '$idbarrio') " );
    }else{
    echo "entro2";
    $result = $conn->query( "UPDATE barrio SET nom_barrio = '$nom_barrio', idcomuna= '$idcomuna'
                             WHERE (idbarrio = '$idbarrio') " );
  }
  // $result = $conn->query( "UPDATE barrio SET nom_barrio = '$nom_barrio', idcomuna= '$idcomuna'
  //                          WHERE (idbarrio = '$idbarrio') " );
  if ( $result ) {
    $res['message'] = 'Estudiante actualizado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de actualizar estudiante.";
  }
}

if ( $action == 'eliminarbarrio' ) {
  $id = $_POST['idbarrio'];
  $result = $conn->query( "DELETE FROM barrio WHERE idbarrio = $id" );

  if ( $result ) {
    $res['message'] = 'Estudiante eliminado con éxito.';
  } else{
    $res['error'] = true;
    $res['message'] = "Error al tratar de eliminar estudiante.";
  }
}

/////////////////////////////// puesto de votacion//////////////////////////

if($action =='listarpuestos'){
  $result = $conn->query( "SELECT puesto_votacion.*, barrio.nom_barrio  FROM puesto_votacion
                            INNER JOIN barrio
                            on barrio.idbarrio = puesto_votacion.idbarrio" );
  $puesto = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $puesto, $row );
  }
  $res['puesto'] = $puesto;
}

if($action =='busquedapuesto'){
  $dato =$_POST['datos'];
  $result = $conn->query( "SELECT puesto_votacion.*, barrio.nom_barrio  FROM puesto_votacion
                            INNER JOIN barrio
                            on barrio.idbarrio = puesto_votacion.idbarrio
                            WHERE puesto_votacion.nombre LIKE '%$dato%'" );
  $puesto = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $puesto, $row );
  }
  $res['puesto'] = $puesto;
}

if($action =='barrios'){
  $result = $conn->query( "SELECT * FROM barrio
                           LEFT OUTER JOIN comuna ON barrio.idcomuna = comuna.idcomuna" );
   $barrio = array();
   while ( $row = $result->fetch_assoc() ) {
    array_push( $barrio, $row );
  }
  $res['barrio'] = $barrio;
}

if($action=='buscarpuesto'){
  $punto =$_POST['punto'];
  $result= $conn->query("SELECT * FROM puesto_votacion WHERE (nombre='$punto')");
  $puesto = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $puesto, $row );
  }
  $res['puesto'] = $puesto;

}

if($action=='agregarpunto'){
  $punto=$_POST['punto'];
  $direccion=$_POST['direccion'];
  $idbarrio=$_POST['idbarrio'];

  $result= $conn->query("INSERT INTO puesto_votacion (nombre,direccion,idbarrio)
                           VALUES ('$punto','$direccion','$idbarrio')" );
  if ( $result ) {
    $res['message'] = 'Estudiante agregado con éxito.';
    } else {
      $res['error'] = true;
      $res['message'] = "Error al tratar de agregar estudiante.";
    }
}

if($action=='editpuesto'){
  $idpuesto =$_POST['idpuesto'];;
  $result= $conn->query("SELECT * FROM puesto_votacion WHERE (idpuesto_votacion='$idpuesto')");
  $puesto = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $puesto, $row );
  }
  $res['puesto'] = $puesto;
}

if ( $action == 'updatepuesto' ) {
  $idpuesto = $_POST['idpuesto'];
  $nombre = $_POST['nombre'];
  $direccion= $_POST['direccion'];
  $idbarrio = $_POST['idbarrio'];
  $result = $conn->query( "UPDATE puesto_votacion SET nombre = '$nombre', direccion= '$direccion', idbarrio= '$idbarrio'
                           WHERE (idpuesto_votacion = '$idpuesto') " );
  if ( $result ) {
    $res['message'] = 'Estudiante actualizado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de actualizar estudiante.";
  }
}

if ( $action == 'eliminarpuesto' ) {
  $id = $_POST['idpuesto'];
  $result = $conn->query( "DELETE FROM puesto_votacion WHERE idpuesto_votacion = $id" );

  if ( $result ) {
    $res['message'] = 'Estudiante eliminado con éxito.';
  } else{
    $res['error'] = true;
    $res['message'] = "Error al tratar de eliminar estudiante.";
  }
}

/////////////////////////// votantes ///////////////////////////////////////////////7

if($action =='puestos'){
  $result = $conn->query( "SELECT * FROM puesto_votacion" );
   $puesto = array();
   while ( $row = $result->fetch_assoc() ) {
    array_push( $puesto, $row );
  }
  $res['puesto'] = $puesto;
}

if($action=='agregarvotante'){
  $planilla=$_POST['planilla'];
  $lider_referido=$_POST['lider_referido'];
  $nombres=$_POST['nombres'];
  $apellidos=$_POST['apellidos'];
  $identificacion=$_POST['identificacion'];
  $celular=$_POST['celular'];
  $direccion=$_POST['direccion'];
  $idbarrio=$_POST['idbarrio'];
  $email=$_POST['email'];
  $idpuesto=$_POST['idpuesto'];
  $result= $conn->query("INSERT INTO datos (num_planilla,lider_referido,nombres,apellidos,identificacion,celular,direccion,idbarrio,email,id_puesto_votacion)
                           VALUES ('$planilla','$lider_referido','$nombres','$apellidos','$identificacion','$celular','$direccion','$idbarrio','$email','$idpuesto')" );
  if ( $result ) {
    $res['message'] = 'Estudiante agregado con éxito.';
    } else {
      $res['error'] = true;
      $res['message'] = "Error al tratar de agregar estudiante.";
    }
}

if($action =='listarvotantes'){
  $result = $conn->query( "SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                            LEFT OUTER JOIN barrio
                            ON barrio.idbarrio = datos.idbarrio
                             LEFT OUTER JOIN puesto_votacion
                            ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion" );
  $votantes = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $votantes, $row );
  }
  $res['votantes'] = $votantes;
}

if($action=='editvotante'){
  $idvotante =$_POST['idvotante'];;
  $result= $conn->query("SELECT * FROM datos WHERE (iddatos='$idvotante')");
  $datos = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $datos, $row );
  }
  $res['datos'] = $datos;
}

if ( $action == 'updatevotantes' ) {
  $id=$_POST['iddatos'];
  $planilla=$_POST['planilla'];
  $lider_referido=$_POST['lider_referido'];
  $nombres=$_POST['nombres'];
  $apellidos=$_POST['apellidos'];
  $identificacion=$_POST['identificacion'];
  $celular=$_POST['celular'];
  $direccion=$_POST['direccion'];
  $idbarrio=$_POST['idbarrio'];
  $email=$_POST['email'];
  $idpuesto=$_POST['idpuesto'];
  $result = $conn->query( "UPDATE datos SET num_planilla = '$planilla',
                           lider_referido= '$lider_referido', nombres= '$nombres',
                           apellidos='$apellidos', identificacion= '$identificacion',
                           celular='$celular', direccion='$direccion', idbarrio='$idbarrio',
                           email='$email', id_puesto_votacion='$idpuesto'
                           WHERE (iddatos = '$id') " );
  if ( $result ) {
    $res['message'] = 'Estudiante actualizado con éxito.';
  } else {
    $res['error'] = true;
    $res['message'] = "Error al tratar de actualizar estudiante.";
  }
}

if ( $action == 'eliminarvotante' ) {
  $id = $_POST['idvotante'];
  $result = $conn->query( "DELETE FROM datos WHERE iddatos = $id" );

  if ( $result ) {
    $res['message'] = 'Estudiante eliminado con éxito.';
  } else{
    $res['error'] = true;
    $res['message'] = "Error al tratar de eliminar estudiante.";
  }
}

if($action=='buscarvotante'){
  $identificacion =$_POST['identificacion'];
  $result= $conn->query("SELECT * FROM datos WHERE (identificacion='$identificacion')");
  $votante = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $votante, $row );
  }
  $res['votante'] = $votante;

}

if($action=='busqueda'){
  $idbusqueda =$_POST['idbusqueda'];
  $datos =$_POST['datos'];
  if ($idbusqueda==1) {

    $result = $conn->query( " SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE datos.num_planilla LIKE '%$datos%' " );
  }
  if ($idbusqueda==2) {

    $result = $conn->query( " SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE datos.lider_referido LIKE '%$datos%' " );
  }
  if ($idbusqueda==3) {
    $result = $conn->query( "SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE datos.nombres LIKE '%$datos%' " );
  }
  if ($idbusqueda==4) {
    $result = $conn->query( "SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE datos.apellidos LIKE '%$datos%' " );

  }
  if ($idbusqueda==5) {
    $result = $conn->query( "SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE barrio.nom_barrio LIKE '%$datos%' " );
  }
  if ($idbusqueda==6) {
    $result = $conn->query( "SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE barrio.email LIKE '%$datos%' " );
  }
  if ($idbusqueda==7) {
    $result = $conn->query( "SELECT datos.*, puesto_votacion.nombre, barrio.nom_barrio  FROM datos
                              LEFT OUTER JOIN barrio
                              ON barrio.idbarrio = datos.idbarrio
                              LEFT OUTER JOIN puesto_votacion
                              ON puesto_votacion.idpuesto_votacion = datos.id_puesto_votacion
                              WHERE puesto_votacion.nombre LIKE '%$datos%' " );
  }
  // $result= $conn->query("SELECT * FROM datos WHERE (identificacion='$identificacion')");
  $votante = array();
  while ( $row = $result->fetch_assoc() ) {
    array_push( $votante, $row );
  }
  $res['votantes'] = $votante;

}


$conn->close();
header( 'Content-type: application/json' );
echo json_encode($res);
