//Estados de botón

function estadoCero() {
  console.log("Entra estado cero");
  $('alertModal').modal('show'); //trigger the modal
  document.getElementById('modalAlertTitle').innerHTML = "¡Notificación!";
  document.getElementById('modalBody').innerHTML = "Se ha iniciado el proceso de extracción,  por favor no detenga el proceso";
  document.getElementById('btn-icon').className = "fa fa-stop";
  //connection.send("PLAY");
}

function estadoUno() {
  $('alertModal').modal('show'); //trigger the modal
  document.getElementById('modalAlertTitle').innerHTML = "¡Alerta!";
  document.getElementById('modalBody').innerHTML = "Al detener el proceso se perderá toda la información extraída";
}

function estadoDos() {
  $('alertModal').modal('show'); //trigger the modal
  document.getElementById('modalAlertTitle').innerHTML = "¡Alerta!";
  document.getElementById('modalBody').innerHTML = "El proceso ha sido detenido, los datos no fueron guardados";
  document.getElementById('btn-icon').className = "fa fa-play";
  //connection.send("STOP");
}


//sockets
var connection = new WebSocket('ws://192.168.56.1:1234');



connection.onmessage = function(evt) {
  var aux = evt.data;
  //console.log("data recived: " + aux + " is number?: " + !isNaN(aux));

  if (aux == "PLAY_BUTTON") {
    estadoCero();
  }
  if (aux == "STOP_BUTTON") {
    estadoDos();
  }
  if (!isNaN(aux)) {
    estadoCero();
    var porcentaje = evt.data;
    porcentaje = Math.trunc(porcentaje);
    if (porcentaje > 0) {
      document.getElementById('span-etapa').innerHTML = "Etapa 1: Creación del directorio Hotelero";
    }
    if (porcentaje > 40) {
      document.getElementById('span-etapa').innerHTML = "Etapa 2: Procesamiento de Información";
    }
    if (porcentaje > 90) {
      document.getElementById('span-etapa').innerHTML = "Etapa 3: Almacenamiento de directorio";
    }

    //Se asigna el porcentaje
    $("#pb").css("width", porcentaje + "%");
    document.getElementById("pbNumber").innerHTML = porcentaje + "%";
  }
  if (aux.startsWith("{")) {

    console.log("************************ JSON ************************");
    var obj = JSON.parse(aux);

    var element = obj['data'];
    console.log("length element: " + element.length);



    for (var i = 0; i < element.length; i++) {
      var item = element[i];
      var auxtipo = item.tipo;




      //Tintineo de campana
      if (i % 2 == 0) {
        setTimeout(function() {
          document.getElementById('icon-bell').className = "fa fa-bell";
        }, 10000);
      } else {
        setTimeout(function() {
          document.getElementById('icon-bell').className = "fa fa-bell-o";
        }, 10000);
      }


      switch (auxtipo) {
        case "0":
          item.tipo = "Extracción Hotelera";
          break;
        case "1":
          console.log("Entra con valor: " + auxtipo);
          item.tipo = "Extracción Extra-hotelera";
          break;
        case "2":
          item.tipo = "Limpieza Hotelera";
          break;
        case "3":
          item.tipo = "Limpieza Extra-hotelera";
          break;
        case "4":
          item.tipo = "Normalización Hotelera";
          break;
        case "5":
          item.tipo = "Normalización Extra-hotelera";
          break;
        default:
          item.tipo = "Indefinido";
          break;
      }

      $("#accordion").append("<div class='card'>" +
        "<div class='card-header' role='tab' id=header" + i + ">" +
        "<span align='center'>" +
        "<a data-toggle='collapse' data-parent='#accordion' href=#notification" + i + ">" +
        "<Strong>Tipo de extracción: </Strong>" + item.tipo + ", <Strong>Fecha: </Strong>" + item.fecha +
        "</a>" +
        "</span>" +
        "</div>" +

        "<div id=notification" + i + " class='collapse' role='tabpanel'>" +
        "<div class='card-block'>" +
        "<strong>Fuente: </strong> <span>" + item.fuente + "</span><br>" +
        "<strong>Destino: </strong> <span>" + item.destino + "</span><br>" +
        "<strong>Parametro: </strong> <span>" + item.parametro + "</span><br>" +
        "<strong>Excepción: </strong> <span>" + item.excepcion + "</span><br>" +
        "<strong>Número de línea: </strong><span>" + item.linea + "</span><br>" +
        "</div>" +
        "</div>" +
        "</div><br>");
      document.getElementById('notification-counter').innerHTML = i + 1;
    }
  } else {
    document.getElementById('span-destino').innerHTML = aux;
  }


}

$('button').click(function() {
  var $counter, val;
  $counter = $('.notification-counter');
  val = parseInt($counter.text());
  val++;
  document.getElementById('notification-counter').innerHTML = val;
});


var toggle = (function(el) {

  var div = document.getElementById(el);
  var states = [];

  var current = 0;
  states[0] = function() {
    console.log("Entra estado 0");
    estadoCero();
    connection.send("PLAY");
  };
  states[1] = function() {
    console.log("Entra estado 1");
    estadoUno();
  };
  states[2] = function() {
    console.log("Entra estado 2");
    estadoDos();
    connection.send("STOP");
  }

  return function() {
    states[current]()
    current = (current + 1) % (states.length);
  }
})("div");

document.getElementById("btn-ht").addEventListener("click", toggle);



// ----- Tipo 0 -> Extracción hotelera, Tipo 1 -> Extracción Extra-hotelera, Tipo 2 -> Limpieza hotelera,
// ----- Tipo 3 -> Limpieza extra, Tipo 4 -> Normalización hotelera, Tipo 5 -> Normalización Extra-hotelera
// ----- Agregar collapse a los items del JSON
// ----- Modificar los tipos de extraccion
// ----- El título lleva fecha y tipo
// ----- Corregir span de Notificaciones
// ----- Limitar el número de clientes a 5
// ----- Porcentaje del contador al centro
//Ejecutar pruebas de cuando los clientes se conectan
//Modificar el login
//Tintineo de campana
//Corregir flujo de los botones de Qt con la web
