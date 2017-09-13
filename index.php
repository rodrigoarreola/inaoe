<?php

  //session_start();
  //if (@!$_SESSION['user']){
  //    header("Location: login.php");
  //}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>My Data Extractor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/8127f74334.js"></script>
    <!--<link rel="stylesheet" href="css/font-awesome.min.css">  -->
    <link rel="stylesheet" href="css/style.css">

    <script type="text/javascript" src="js/sockets.js"></script>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">My extractor</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Extracción <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Reportes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Ayuda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </nav>
    <br>

    <!-- Card Extraccion --> <!--  -->
    <div class="jumbotron">
      <div class="card">
        <div class="card-header">
          Creación del directorio hotelero
        </div>
        <div class="card-block" id="card-ht">

          <div class="container">
            <div class="row" align="center">
              <div class="col">
                <span id="span-etapa" class="col-12 center"></span>
              </div>
            </div>
            <div class="row" align="center">
              <div class="col">
                <span id="span-destino"></span><br>
              </div>
            </div>
          </div>

          <br>
          <div class="row">
            <div class="col-2">
              <button type="button" id="btn-ht" class="btn btn-success" data-toggle="modal" data-target="#alertModal">
                <i id="btn-icon" class="fa fa-play" aria-hidden="true"></i>
              </button>
            </div>
            <div class="col-8">
              <div class="progress">
                <div id="pb" class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"  style="width: 0%; height: 40px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                  <h5 id="pbNumber"></h5>
                </div>
              </div>
            </div>
            <div class="col-2">
              <button type="button" id="btn-bell" class="btn btn-warning" data-toggle="collapse" data-target="#collapse-notifications">
                <i id="icon-bell" class="fa fa-bell" aria-hidden="true"></i>
                <span id="notification-counter" class="notification-counter">0</span>
              </button>
            </div>
          </div>
          <br>



          <div class="collapse" id="collapse-notifications">
            <div class="container wrapp" id="wrapp">
              <div id="accordion" role="tablist">

              </div>
            </div>
          </div>




            <!-- Modal -->
            <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalAlertTitle">¡Alerta!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modalBody">
                    Al detener el proceso se perderá toda la información extraída
                  </div>
                  <div class="modal-footer">
                      <!--
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn-danger-aceptar" data-dismiss="modal" class="btn btn-danger">Aceptar</button>
                      -->
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>

      <br>

      <div class="card">
        <div class="card-header">
          Creación del directorio extra-hotelero
        </div>
        <div class="card-block">
          <div class="row">
            <div class="col-2">
              <button type="button" id="btn-ht" class="btn btn-success" data-toggle="modal" data-target="#alertModal">
                <i id="btn-icon" class="fa fa-play" aria-hidden="true"></i>
              </button>
            </div>
            <div class="col-8">
              <div class="progress">
                <div id="pb2"class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"  style="width: 100%; height: 40px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="col-2">
              <button type="button" id="btn-bell" class="btn btn-warning" data-toggle="modal" data-target="#logModal">
                <i  class="fa fa-bell" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/myscript.js"></script>
    <script type="text/javascript" src="js/sockets.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    -->
  </body>
</html>
