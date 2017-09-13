<?php
  $usuario = $_POST['usuario'];
  $pass = $_POST['password'];
  echo $usuario, $pass;

  $conn_string = "host=localhost port=5432 dbname=inaoe user=rodrigo password=root";
  $dbconn = pg_connect($conn_string);

  $result = pg_query("SELECT * FROM users WHERE user= '" . $usuario . "'");


    if($row = pg_fetch_array($result)){
        if($row['pass'] == $pass){

            if($row['user'] =="admin"){
                session_start();
              header("Location: indexAdmin.php");
            }
            else{
            session_start();
            $_SESSION['user'] = $usuario;
            header("Location: index.php");
          }
        }else{
            header("Location: login.php");
            exit();
        }
    }else{
        header("Location: login.php");
        exit();
    }
?>
