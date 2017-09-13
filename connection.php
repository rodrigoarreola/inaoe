<?php
  $usuario = $_POST['usuario'];
  $pass = $_POST['password'];
  echo $usuario, $pass;

  $conn_string = "host=localhost port=5432 dbname=inaoe user=rodrigo password=root";
  $dbconn = pg_connect($conn_string);

  $result = pg_query("SELECT * FROM users WHERE user= '" . $usuario . "'");


    if($row = pg_fetch_array($result)){
        if($row['pass'] == $pass){

            // $_id=$row['id'];
            if($row['user'] =="admin"){
                session_start();
              header("Location: indexAdmin.php");
            }
            else{
            session_start();
            $_SESSION['user'] = $usuario;
            header("Location: index.php"); //Si hay algun usuario en la DB que coincida con el ingresado entra a main
          }
        }else{
            header("Location: login.php"); //Si no se queda en index.php
            exit();
        }
    }else{
        header("Location: login.php");
        exit();
    }
?>
